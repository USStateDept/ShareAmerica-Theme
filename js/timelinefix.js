jQuery(window).load(function(){
  if ( jQuery( '.tl-timeline' ).length ) {
    tdAnimationStack._ready_for_initialization = false;

    if ( undefined !== window.td_animation_stack_effect ) {
        if ( '' === window.td_animation_stack_effect ) {
            window.td_animation_stack_effect = tdAnimationStack._animation_default_effect;
        }
        jQuery( 'body' ).removeClass( 'td-animation-stack-' + window.td_animation_stack_effect );
    }
    return;
  }
});