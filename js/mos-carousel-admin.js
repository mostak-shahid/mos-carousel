jQuery(document).ready(function($) {
    $(window).load(function(){
      $('.mos-carousel-wrapper .tab-con').hide();
      $('.mos-carousel-wrapper .tab-con.active').show();
    });

    $('.mos-carousel-wrapper .tab-nav > a').click(function(event) {
      event.preventDefault();
      var id = $(this).data('id');

      set_mos_carousel_cookie('plugin_active_tab',id,1);
      $('#mos-carousel-'+id).addClass('active').show();
      $('#mos-carousel-'+id).siblings('div').removeClass('active').hide();

      $(this).closest('.tab-nav').addClass('active');
      $(this).closest('.tab-nav').siblings().removeClass('active');
    });
});
