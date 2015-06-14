/**
 * backbonedemo
 * bbdeno
 *
 * Copyright (c) 2015 adamsilverstein
 * Licensed under the GPLv2+ license.
 */


 ( function( $ ) {
 	$( document ).ready( function() {


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

			initialize: function( postId ){
				this.postId = postId;

			},

			/**
			 * Override the default sync method to call our custom API endpoint.
			 */
			sync: function( method, model, options ) {

				/**
				 * Adjust the sync url: set to our api url, with hard coded post 1 url.
				 */
				options.url = demodata.apiurl + '/posts/' + this.postId;

				/**
				 * Pass back to the default handler.
				 */
				return Backbone.sync( method, model, options );
			}

		} );

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

			refresh: function( id ) {
				var self = this;

				this.model = new bbdemo.model.PostModel( id );
				this.model.fetch({
					success: function() {
						self.render();
					}
				});
			},

			render: function() {
				this.$el.html(
					this.template(
						this.model.attributes
						)
					);
				$( '.backbonedemodetail' ).html( this.el );

			return this;
			},
		} );

		bbdemo.PostCollectionView = wp.Backbone.View.extend( {
			/**
			 * Set the view class and template.
			 */
			className: 'backbonedemo',
			template:  wp.template( 'backbonedemo-postlistitem' ),

			/**
			 * Initialize the view.
			 */
			initialize: function( postCollection ) {
				this.postCollection = postCollection;
				this.render();
			},

			/**
			 * Render the collection view
			 */
			render: function() {
				var self = this;
				_.each( this.postCollection.models, function( model ) {
					self.$el.append(
						self.template(
							model.attributes
						)
					);
				} );

				return this;
			}
		} );

		/**
		 * ==========================================
		 * COLLECTIONS
		 * ==========================================
		 */
		bbdemo.PostCollection = Backbone.Collection.extend( {} );

		/**
		 * ==========================================
		 * ROUTES
		 * ==========================================
		 */
		bbdemo.Router = Backbone.Router.extend( {

			/**
			 * Set up the route
			 */
			routes: {

				/**
				 * Route is 'post'+id number, eg /#post10
				 */
				"post:postId": "postRoute"
			},

			/**
			 * Handle the postRoute callback - show the post.
			 */
			postRoute: function( postId ) {

				/**
				 * Set up the PostView
				 */
				var postview = new bbdemo.view.PostView();

				/**
				 * Set the post ID, trigginering a fetch.
				 */
				postview.refresh( postId );
			}

		} );


		/**
		 * ==========================================
		 * MAIN APP SETUP
		 * ==========================================
		 */

		/**
		 * Funciton to initialize the application.
		 */
		bbdemo.initialize = function() {
			/**
			 * Set up the post collection with the bootstrapped date.
			 */
			var postCollection     = new bbdemo.PostCollection( demodata.posts ),

				/**
				 * Set up the post collection view, passing the collection.
				 */
				postCollectionView = new bbdemo.PostCollectionView( postCollection ),

				/**
				 * Set up the Router.
				 */
				bbRouter           = new bbdemo.Router();

				/**
				 * Start the history engine.
				 */
				Backbone.history.start();

				/**
				 * Insert the collection view into the DOM.
				 */
				$( 'body' ).append( postCollectionView.el );
		}

		/**
		 * Go! Initialize the application one document ready.
		 */
		$( document ).ready( function() {
			bbdemo.initialize();
		});

	});
 } )( jQuery );