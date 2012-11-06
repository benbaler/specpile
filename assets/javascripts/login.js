alert('test');

require.config({
  paths: {
    jquery: 'libs/jquery.min',
    underscore: 'libs/underscore.min',
    backbone: 'libs/backbone.min'
  }

});

define([
  'jquery',
  'underscore',
  'backbone'
], function($, _, Backbone){
	alert('test');
});