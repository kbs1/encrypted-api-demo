"use strict";

(function(root)
{
	var View = function()
	{
		if (!(this instanceof View))
			throw Error('View must be instanitated with `new`');

		this.registerHandlers();
	}

	View.prototype.registerHandlers = function()
	{
		$('.demo-tabs a').click(function (e) {
			e.preventDefault();
			$('.demo-tabs li').removeClass('active');
			$(this).closest('li').addClass('active');
			$('.demo-tabs-content .tab-pane').removeClass('active');
			$('.demo-tabs-content .tab-pane#' + $(this).attr('aria-controls')).addClass('active');
		});
	}

	module.exports = View;
})(this);
