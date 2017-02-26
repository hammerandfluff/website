/**
 * Navigation class switching on scroll depth.
 */

// Import dependencies
import throttle from 'lodash.throttle';

/**
 * Initialize and run the menu class switching based on scroll depth.
 * @return {void}
 */
const onScroll = () => {
	// Measure top
	const threshold = 200;
	const classList = document.body.classList;
	const top = document.documentElement.scrollTop || document.body.scrollTop;

	if ( threshold < top && !classList.contains( 'minimized-nav' ) ) {
		classList.add( 'minimized-nav' );
	} else if ( threshold > top && classList.contains( 'minimized-nav' ) ) {
		document.body.classList.remove( 'minimized-nav' );
	}
};

/**
 * Initializes the duplicated menu and sets up events.
 *
 * @param  {string} query The query for the node containing the menu markup.
 * @return {void}
 */
export default function init( query ) {
	const node = document.getElementById( query );
	const header = node.cloneNode( true );

	header.id = null;
	header.classList.add( 'menu-clone' );
	document.body.appendChild( header );
	window.addEventListener( 'scroll', throttle( onScroll, 250 ), true );
	document.body.classList.add( 'clone-init' );
}
