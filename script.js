(function($) {
  'use strict';

  var data = {
    pivotPoint: 0
  };

  var octopus = {
    initialize: function() {
      views.initializeNavbar();
      views.initializeFullSizeImage();
      if ($('.gallery').length > 0) {
        views.initializeGallery();
      }

      if (typeof google !== "undefined") {
        google.maps.event.addDomListener(window, 'load', views.initializeMap);
      }
      $(document).on('scroll', views.initializeNavbar);
      $(window).on('resize', octopus.resetPivotPoint);
      $(window).on('resize', views.initializeFullSizeImage);
    },

    setPivotPoint: function(pivotPoint) {
      data.pivotPoint = data.pivotPoint || pivotPoint;
    },

    getPivotPoint: function() {
      return data.pivotPoint;
    },

    resetPivotPoint: function() {
      data.pivotPoint = window.innerHeight;
    }
  };

  var views = {
    initializeNavbar: function () {
      var scrollTop = $(window).scrollTop();
      var navbar = $("#main-navbar");
      var windowHeight = window.innerHeight;

      if (navbar.parent()[0] === $("body")[0]) {
        return;
      }

      octopus.setPivotPoint(navbar.offset().top);

      if (scrollTop > octopus.getPivotPoint()) {
        navbar
          .removeClass("navbar-style")
          .addClass("navbar-fixed-top")
        ;
      } else {
        navbar
          .addClass("navbar-style")
          .removeClass("navbar-fixed-top")
        ;
      }
    },

    initializeFullSizeImage: function() {
      var fullSizeDiv = $(".full-size");

      if (fullSizeDiv.length == 0) return;

      var windowHeight = window.innerHeight;
      var menuHeight = $(".full-size .menu").height() + parseInt($(".full-size .menu").css("margin-bottom"), 10);
      
      fullSizeDiv.height(windowHeight);
      $(".full-size .image").height(windowHeight - menuHeight);
    },

    initializeMap: function() {
      var mapOptions = {
        center: new google.maps.LatLng(47.179974, 27.569116),
        zoom: 15,
        scrollwheel: false
      };
      var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(47.185432, 27.567080),
        map: map,
        title: 'Liceul Teoretic de Informatică "Grigore Moisil" Iași'
      });

      var marker = new google.maps.Marker({
        position: new google.maps.LatLng(47.173241, 27.572353),
        map: map,
        title: 'Universitatea AL.I.Cuza - Aula "M.Eminescu" '
      });
    },

    initializeGallery: function() {
      var grid = $('.gallery').masonry({
        // options
        itemSelector: '.gallery-item',
        columnWidth: '.gallery-item',
        percentPosition: true
      });

      grid.imagesLoaded().progress( function() {
        grid.masonry('layout');
      });
    }
  };


  octopus.initialize();
})(jQuery);

