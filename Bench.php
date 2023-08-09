<?php

if ( ! file_exists( __DIR__ . '/html-api' ) ) {
	fwrite( STDERR, "You must first run: composer run-script download\n" );
	exit( 1 );
}

/**
 * Escape attribute value.
 *
 * Stub for core's esc_attr() which is used in WP_HTML_Tag_Processor.
 *
 * @param string $value Value.
 * @return string Escaped value.
 */
function esc_attr( $value ) {
	return htmlspecialchars( $value, ENT_QUOTES );
}

// Load HTML API.
require_once __DIR__ . '/html-api/class-wp-html-tag-processor.php';
foreach ( glob( __DIR__ . '/html-api/*.php' ) as $file ) {
	require_once $file;
}

/**
 * @BeforeMethods("setUp")
 * @Revs(100)
 * @Iterations(5)
 */
class Bench {

	public $files = [];

	public function setUp() {
		$this->files = glob( __DIR__ . '/test-data/*.html' );
	}

	function assertAttributesAbsent( string $html ): void {
		if ( str_contains( $html, ' fetchpriority="high"' ) ) {
			throw new Exception( 'Unexpected fetchpriority=high' );
		}
		if ( str_contains( $html, ' loading="lazy"' ) ) {
			throw new Exception( 'Unexpected loading=lazy' );
		}
		if ( preg_match( '/<script[^>]+?defer/', $html ) ) {
			throw new Exception( 'Unexpected defer script' );
		}
	}

	function assertAttributesPresent( string $html ): void {
		if ( ! str_contains( $html, ' fetchpriority="high"' ) ) {
			throw new Exception( 'Expected fetchpriority=high' );
		}
		if ( ! str_contains( $html, ' loading="lazy"' ) ) {
			throw new Exception( 'Expected loading=lazy' );
		}
		if ( ! preg_match( '/<script[^>]+?defer/', $html ) ) {
			echo $html;
			throw new Exception( 'Expected defer script' );
		}
	}

	/**
	 * Test using preg_replace_callback() and preg_match() to inject fetchpriority="high" and loading="lazy".
	 */
	function benchPregReplace(): void {
		foreach ( $this->files as $file ) {
			$html = file_get_contents( $file );
			$this->assertAttributesAbsent( $html );

			$image_count = 0;
			$applied_fetchpriority = false;

			$html = preg_replace_callback(
				'#<img([^>]+?)>#',
				static function ( $matches ) use ( &$image_count, &$applied_fetchpriority ) {
					$image_count++;

					$attrs  = $matches[1];
					$width  = preg_match( '/\swidth=["\']([0-9]+)["\']/', $attrs, $match_width ) ? (int) $match_width[1] : null;
					$height = preg_match( '/\sheight=["\']([0-9]+)["\']/', $attrs, $match_height ) ? (int) $match_height[1] : null;

					if ( ! $applied_fetchpriority && $width * $height >= 50000 ) {
						$attrs .= ' fetchpriority="high"';
						$applied_fetchpriority = true;
					} else if ( $image_count > 2 ) {
						$attrs .= ' loading="lazy"';
					}

					return "<img{$attrs}>";
				},
				$html
			);

			// Also add defer to a script.
			$html = preg_replace_callback(
				'#<script([^>]+)>#',
				static function ( $matches ) {
					$attrs = $matches[1];

					$is_external = preg_match( '/\ssrc=/', $attrs );
					$is_defer    = preg_match( '/\sdefer/', $attrs );
					$is_async    = preg_match( '/\sasync/', $attrs );

					if ( $is_external && ! $is_defer && ! $is_async ) {
						$attrs .= ' defer';
					}

					return "<script{$attrs}>";
				},
				$html
			);

			$this->assertAttributesPresent( $html );
		}
	}

	/**
	 * Test using WP_HTML_Tag_Processor to inject fetchpriority="high" and loading="lazy".
	 */
	function benchHtmlTagProcessor(): void {
		foreach ( $this->files as $file ) {
			$html = file_get_contents( $file );
			$this->assertAttributesAbsent( $html );

			$image_count = 0;
			$applied_fetchpriority = false;

			$p = new WP_HTML_Tag_Processor( $html );
			while ( $p->next_tag( 'img' ) ) {
				$image_count++;

				$width = (int) $p->get_attribute( 'width' );
				$height = (int) $p->get_attribute( 'height' );

				if ( ! $applied_fetchpriority && $width * $height >= 50000 ) {
					$p->set_attribute( 'fetchpriority', 'high' );
					$applied_fetchpriority = true;
				} else if ( $image_count > 2 ) {
					$p->set_attribute( 'loading', 'lazy' );
				}
			}

			$html = $p->get_updated_html(); // TODO: This is only needed because of the next line.
			$p = new WP_HTML_Tag_Processor( $html ); // TODO: Why can't the previous instance be reused?

			while ( $p->next_tag( 'script' ) ) {
				if (
					$p->get_attribute( 'src' ) &&
					! $p->get_attribute( 'defer' ) &&
					! $p->get_attribute( 'async' )
				) {
					$p->set_attribute( 'defer', true );
				}
			}

			$html = $p->get_updated_html();
			$this->assertAttributesPresent( $html );
		}
	}
}
