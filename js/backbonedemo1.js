/**
 * backbonedemo
 * bbdeno
 *
 * Copyright (c) 2015 adamsilverstein
 * Licensed under the GPLv2+ license.
 */


 ( function( $ ) {
	'use strict';

	window.wp     = window.wp || {};
	window.bbdemo = window.bbdemo || {};

	bbdemo.model = {};
	bbdemo.view  = {};

	/**
	 * ==========================================
	 * MODELS
	 * ==========================================
	 */
	bbdemo.model.PostModel = Backbone.Model.extend( {

		/**
		 * Initialize the model.
		 */
		initialize: function() {
			console.log( 'bbdemo.model.PostModel' );
		},


		/**
		 * Override the default sync method to call our custom API endpoint.
		 */
		sync: function( method, model, options ) {
			console.log( 'bbdemo.model.PostModel::sync' );
			/**
			 * Adjust the sync url: set to our api url, with hard coded post 1 url.
			 */
			options.url = demodata.apiurl + 'posts/1';

			/**
			 * Pass back to the default handler.
			 */
			return Backbone.sync( method, model, options );
		}


	})

	/**
	 * ==========================================
	 * VIEWS
	 * ==========================================
	 */

	/**
	 * The main post view.
	 */
	bbdemo.view.PostView = wp.Backbone.View.extend( {

		/**
		 * Set the view class and template.
		 */
		className: 'backbonedemo',
		template:  wp.template( 'backbonedemo-post' ),

		/**
		 * Initialize the view.
		 */
		initialize: function( model ) {
			var self = this;
			console.log( 'bbdemo.view.PostView' );
			this.model = model;
			this.model.fetch({
				success: function() {
					self.render();
				}
			});

		},

		render: function() {

			console.log( 'bbdemo.view.PostView::render' );
			console.log( this );
			console.log( this.$el );
			jQuery( '.backbonedemo' ).html( this.template( this.model.attributes ) );

			return this;
		},


	});





	/**
	 * ==========================================
	 * MAIN APP SETUP
	 * ==========================================
	 */

	/**
	 * Funciton to initialize the application.
	 */
	bbdemo.initialize = function() {
		console.log( 'bbdemo.initialize' );
		var postmodel = new bbdemo.model.PostModel();
		bbdemo.view.postview = new bbdemo.view.PostView( postmodel );
	}

	$( document ).ready( function() {
		/**
		 * Go! Initialize the application.
		 */
		bbdemo.initialize();
	});


 } )( jQuery );