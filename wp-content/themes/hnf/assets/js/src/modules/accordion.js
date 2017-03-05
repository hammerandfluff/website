/**
 * Create a set of accordions for an element.
 */

/**
 * Calculates the vertical height of an expanded tab.
 *
 * @param  {DOMElement} tab The Tab DOM node.
 * @return {number}         The calculated height for the tab.
 */
const calculateTabSize = ( tab ) => {
	const width = tab.contentCache.offsetWidth;

	tab.classList.remove( 'bbrow-tab-initialized' );

	tab.contentCache.style.width = `${width}px`;
	tab.contentCache.style.position = 'absolute';
	tab.contentCache.style.zIndex = '-1';
	tab.contentCache.style.maxHeight = 'none';

	const height = tab.contentCache.offsetHeight;

	tab.contentCache.style.width = null;
	tab.contentCache.style.position = null;
	tab.contentCache.style.zIndex = null;
	tab.classList.add( 'bbrow-tab-initialized' );

	return height;
};

/**
 * Ensures the contentCache is available and sets it if not.
 *
 * @param  {DOMElement} tab The tab element being worked on.
 * @return {void}
 */
const ensureContentCache = ( tab ) => {
	if ( !tab.contentCache ) {
		tab.contentCache = tab.getElementsByClassName( 'bbrow-tab-content' )[0];
	}
};

/**
 * Checks to see if a cached height is available, and measures if not.
 *
 * @param  {DOMElement} tab The tab currently being worked on.
 * @return {boolean}        Whether or not a new cache was generated.
 */
const maybeMeasureHeight = ( tab ) => {
	const vpWidth = Math.max(
		document.documentElement.clientWidth,
		window.innerWidth || 0
	);

	if ( String( tab.dataset.viewPortSizeCache ) !== String( vpWidth )
		|| undefined === tab.dataset.heightCache ) {
		ensureContentCache( tab );
		tab.dataset.heightCache = calculateTabSize( tab );
		tab.dataset.viewPortSizeCache = vpWidth;

		return true;
	}

	return false;
};

/**
 * Sets the initial height of a tab.
 *
 * @param  {DOMElement} tab The tab for which to set the initial height.
 * @return {void}
 */
const setInitialHeight = ( tab ) => {
	if ( tab.classList.contains( 'bbrow-tab-open' ) ) {
		tab.contentCache.style.maxHeight = `${tab.dataset.heightCache}px`;
	} else {
		tab.contentCache.style.maxHeight = 0;
	}
};

/**
 * Toggles the max height of a tab content, measuring the height if needed.
 *
 * @param  {DOMElement} tab The tab being worked on.
 * @return {void}
 */
const toggleMaxHeight = ( tab ) => {
	if ( maybeMeasureHeight( tab ) ) {
		setInitialHeight( tab );
	}
	window.setTimeout( () => {
		if ( tab.classList.contains( 'bbrow-tab-open' ) ) {
			tab.classList.remove( 'bbrow-tab-open' );
			tab.contentCache.style.maxHeight = 0;
		} else {
			tab.classList.add( 'bbrow-tab-open' );
			tab.contentCache.style.maxHeight = `${tab.dataset.heightCache}px`;
		}
	}, 1 );
};

/**
 * Initialize a tab accordion item.
 *
 * @param  {DOMElement} tab The tab to initialize.
 * @return {void}
 */
const initializeToggle = ( tab ) => {
	maybeMeasureHeight( tab );
	setInitialHeight( tab );
};

/**
 * Click handler to open and close tabs.
 * @param  {object} event The click event object.
 * @return {boolean}      false to stop further action.
 */
const eventClickTab = ( event ) => {
	event.preventDefault();

	let el = event.target;
	let tabTitle = false;

	while ( !el.classList.contains( 'bbrow-tab' ) ) {
		if ( el.classList.contains( 'bbrow-tab-title' ) ) {
			tabTitle = true;
		}
		if ( el === document.body ) {
			return false;
		}
		el = el.parentElement;
	}
	if ( tabTitle ) {
		toggleMaxHeight( el );
	}

	return false;
};

/**
 * Initialize the accordion feature for a container.
 * @param  {string} container A class to initialize accordions in.
 * @return {void}
 */
const init = ( container = 'fl-builder-content' ) => {
	Array.prototype.map.call(
		document.getElementsByClassName( container ),
		( el ) => {
			Array.prototype.map.call(
				el.getElementsByClassName( 'bbrow-tab' ),
				initializeToggle
			);
			el.addEventListener( 'click', eventClickTab );
		}
	);
};

/**
 * Test if we should initialize or not.
 *
 * @param  {string} container A class to initialize accordions in.
 * @return {void}
 */
export default function test( container = 'fl-builder-content' ) {
	const store = document.getElementsByClassName( 'fl-builder-bar' );

	if ( 0 >= store.length ) {
		console.log( 'yes' );
		init( container );
	}
}
