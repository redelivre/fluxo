jQuery(document).ready(function() {
    if(jQuery('.site-content').lenght > 0) {
        jQuery('.site-content').fullpage({
        	// Navigation
        	anchors:['intro', 'para-quem-fazemos', 'o-que-fazemos', 'como-fazemos', 'cadastro'],
    
        	// Design
        	fixedElements: '.site-footer',
    
        	// Scroll
        	autoScrolling: false,
        	fitToSection: false,
    
        	// Custom selectors
            sectionSelector: '.pane',
        });
    }
});