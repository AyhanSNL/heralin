/* Name: 			Theme Base Written by: 	Okler Themes - (http://www.okler.net) Theme Version:	6.2.1 *//* Theme*/window.theme = {};/* Theme Common Functions*/window.theme.fn = {getOptions: function(opts) {if (typeof(opts) == 'object') {return opts;} else if (typeof(opts) == 'string') {try {return JSON.parse(opts.replace(/'/g,'"').replace(';',''));} catch(e) {return {};}} else {return {};}}};/* Animate*/(function(theme, $) {theme = theme || {};var instanceName = '__animate';var PluginAnimate = function($el, opts) {return this.initialize($el, opts);};PluginAnimate.defaults = {accX: 0, accY: -80, delay: 100, duration: '750ms'};PluginAnimate.prototype = {initialize: function($el, opts) {if ($el.data(instanceName)) {return this;}this.$el = $el;this.setData().setOptions(opts).build();return this;}, setData: function() {this.$el.data(instanceName, this);return this;}, setOptions: function(opts) {this.options = $.extend(true, {}, PluginAnimate.defaults, opts, {wrapper: this.$el});return this;}, build: function() {var self = this, $el = this.options.wrapper, delay = 0, duration = this.options.duration, elTopDistance = $el.offset().top, windowTopDistance = $(window).scrollTop();$el.addClass('appear-animation animated');if (!$('html').hasClass('no-csstransitions') && $(window).width() > 767 && elTopDistance > windowTopDistance) {$el.appear(function() {$el.one('animation:show', function(ev) {delay = ($el.attr('data-appear-animation-delay') ? $el.attr('data-appear-animation-delay') : self.options.delay);duration = ($el.attr('data-appear-animation-duration') ? $el.attr('data-appear-animation-duration') : self.options.duration);if (duration != '750ms') {$el.css('animation-duration', duration);}$el.css('animation-delay', delay + 'ms');$el.addClass($el.attr('data-appear-animation') + ' appear-animation-visible');});$el.trigger('animation:show');}, {accX: self.options.accX, accY: self.options.accY});} else {$el.addClass('appear-animation-visible');}return this;}};/* expose to scope*/$.extend(theme, {PluginAnimate: PluginAnimate});/* jquery plugin*/$.fn.themePluginAnimate = function(opts) {return this.map(function() {var $this = $(this);if ($this.data(instanceName)) {return $this.data(instanceName);} else {return new PluginAnimate($this, opts);}});};}).apply(this, [window.theme, jQuery]);/* Carousel*/(function(theme, $) {theme = theme || {};var instanceName = '__carousel';var PluginCarousel = function($el, opts) {return this.initialize($el, opts);};PluginCarousel.defaults = {loop: true, responsive: {0: {items: 1}, 479: {items: 1}, 768: {items: 2}, 979: {items: 3}, 1199: {items: 4}}, navText: []};PluginCarousel.prototype = {initialize: function($el, opts) {if ($el.data(instanceName)) {return this;}this.$el = $el;this.setData().setOptions(opts).build();return this;}, setData: function() {this.$el.data(instanceName, this);return this;}, setOptions: function(opts) {this.options = $.extend(true, {}, PluginCarousel.defaults, opts, {wrapper: this.$el});return this;}, build: function() {if (!($.isFunction($.fn.owlCarousel))) {return this;}var self = this, $el = this.options.wrapper;/* Add Theme Class*/$el.addClass('owl-theme');/* Force RTL according to HTML dir attribute*/if ($('html').attr('dir') == 'rtl') {this.options = $.extend(true, {}, this.options, {rtl: true});}if (this.options.items == 1) {this.options.responsive = {}}if (this.options.items > 4) {this.options = $.extend(true, {}, this.options, {responsive: {1199: {items: this.options.items}}});}/* Auto Height Fixes*/if (this.options.autoHeight) {var itemsHeight = [];$el.find('.owl-item').each(function(){if( $(this).hasClass('active') ) {itemsHeight.push( $(this).height() );}});$(window).afterResize(function() {$el.find('.owl-stage-outer').height( Math.max.apply(null, itemsHeight) );});$(window).on('load', function() {$el.find('.owl-stage-outer').height( Math.max.apply(null, itemsHeight) );});}/* Initialize OwlCarousel*/$el.owlCarousel(this.options).addClass('owl-carousel-init');/* Sync*/if ($el.attr('data-sync')) {$el.on('change.owl.carousel', function(event) {if (event.namespace && event.property.name === 'position') {var target = event.relatedTarget.relative(event.property.value, true);$( $el.data('sync') ).owlCarousel('to', target, 300, true);}});}return this;}};/* expose to scope*/$.extend(theme, {PluginCarousel: PluginCarousel});/* jquery plugin*/$.fn.themePluginCarousel = function(opts) {return this.map(function() {var $this = $(this);if ($this.data(instanceName)) {return $this.data(instanceName);} else {return new PluginCarousel($this, opts);}});}}).apply(this, [window.theme, jQuery]);/* Counter*/(function(theme, $) {theme = theme || {};var instanceName = '__counter';var PluginCounter = function($el, opts) {return this.initialize($el, opts);};PluginCounter.defaults = {accX: 0, accY: 0, speed: 3000, refreshInterval: 100, decimals: 0, onUpdate: null, onComplete: null};PluginCounter.prototype = {initialize: function($el, opts) {if ($el.data(instanceName)) {return this;}this.$el = $el;this.setData().setOptions(opts).build();return this;}, setData: function() {this.$el.data(instanceName, this);return this;}, setOptions: function(opts) {this.options = $.extend(true, {}, PluginCounter.defaults, opts, {wrapper: this.$el});return this;}, build: function() {if (!($.isFunction($.fn.countTo))) {return this;}var self = this, $el = this.options.wrapper;$.extend(self.options, {onComplete: function() {if ($el.data('append')) {$el.html($el.html() + $el.data('append'));}if ($el.data('prepend')) {$el.html($el.data('prepend') + $el.html());}}});$el.appear(function() {$el.countTo(self.options);}, {accX: self.options.accX, accY: self.options.accY});return this;}};/* expose to scope*/$.extend(theme, {PluginCounter: PluginCounter});/* jquery plugin*/$.fn.themePluginCounter = function(opts) {return this.map(function() {var $this = $(this);if ($this.data(instanceName)) {return $this.data(instanceName);} else {return new PluginCounter($this, opts);}});}}).apply(this, [window.theme, jQuery]);(function(theme, $) {theme = theme || {};var instanceName = '__toggle';var PluginToggle = function($el, opts) {return this.initialize($el, opts);};PluginToggle.defaults = {duration: 350, isAccordion: false};PluginToggle.prototype = {initialize: function($el, opts) {if ($el.data(instanceName)) {return this;}this.$el = $el;this.setData().setOptions(opts).build();return this;}, setData: function() {this.$el.data(instanceName, this);return this;}, setOptions: function(opts) {this.options = $.extend(true, {}, PluginToggle.defaults, opts, {wrapper: this.$el});return this;}, build: function() {var self = this, $wrapper = this.options.wrapper, $items = $wrapper.find('.toggle'), $el = null;$items.each(function() {$el = $(this);if ($el.hasClass('active')) {$el.find('> p').addClass('preview-active');$el.find('> .toggle-content').slideDown(self.options.duration);}self.events($el);});if (self.options.isAccordion) {self.options.duration = self.options.duration / 2;}return this;}, events: function($el) {var self = this, previewParCurrentHeight = 0, previewParAnimateHeight = 0, toggleContent = null;$el.find('> label').click(function(e) {var $this = $(this), parentSection = $this.parent(), parentWrapper = $this.parents('.toggle'), previewPar = null, closeElement = null;if (self.options.isAccordion && typeof(e.originalEvent) != 'undefined') {closeElement = parentWrapper.find('.toggle.active > label');if (closeElement[0] == $this[0]) {return;}}parentSection.toggleClass('active');/* Preview Paragraph*/if (parentSection.find('> p').get(0)) {previewPar = parentSection.find('> p');previewParCurrentHeight = previewPar.css('height');previewPar.css('height', 'auto');previewParAnimateHeight = previewPar.css('height');previewPar.css('height', previewParCurrentHeight);}/* Content*/toggleContent = parentSection.find('> .toggle-content');if (parentSection.hasClass('active')) {$(previewPar).animate({height: previewParAnimateHeight}, self.options.duration, function() {$(this).addClass('preview-active');});toggleContent.slideDown(self.options.duration, function() {if (closeElement) {closeElement.trigger('click');}});} else {$(previewPar).animate({height: 0}, self.options.duration, function() {$(this).removeClass('preview-active');});toggleContent.slideUp(self.options.duration);}});}};/* expose to scope*/$.extend(theme, {PluginToggle: PluginToggle});/* jquery plugin*/$.fn.themePluginToggle = function(opts) {return this.map(function() {var $this = $(this);if ($this.data(instanceName)) {return $this.data(instanceName);} else {return new PluginToggle($this, opts);}});}}).apply(this, [window.theme, jQuery]);