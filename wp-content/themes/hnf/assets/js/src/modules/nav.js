/**
 * Navigation class switching on scroll depth.
 */

// Import dependencies
import throttle from 'lodash.throttle';

/**
 * Initialize and run the menu class switching based on scroll depth.
 * @return {void}
 */
export default function inialize() {
	const classList = document.body.classList;

	window.addEventListener( 'scroll', throttle( () => {
		// Measure top
		const top = document.documentElement.scrollTop || document.body.scrollTop;

		if ( 60 < top && !classList.contains( 'minimized-nav' ) ) {
			classList.add( 'minimized-nav' );
		} else if ( 60 > top && classList.contains( 'minimized-nav' ) ) {
			document.body.classList.remove( 'minimized-nav' );
		}
	}, 250 ), false );
}
