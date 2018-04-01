"use strict";

(function(root)
{
	var View = function()
	{
		if (!(this instanceof View))
			throw Error('View must be instanitated with `new`');

		//this.ajax = require('ajax-request');
		//this.loading = false;

		//this.registerHandlers();
	}

	View.prototype.registerHandlers = function()
	{
		return;
		$(document).ready(this.loadPoolStats.bind(this));
		window.setInterval(this.loadPoolStats.bind(this), 30000);

		$('.home-view #balanceCheckForm').submit(this.checkBalance.bind(this));
		$('.home-view .stat-tabs li').click(this.handleTabs);
	}

	View.prototype.checkBalance = function()
	{
		return;
		if (this.loading)
			return false;

		$('.home-view #balanceCheckForm button').addClass('is-loading');
		this.loading = true;

		var request = {
			'url': '/api/wallet/balance',
			'method': 'POST',
			'data': {
				'address': $('.home-view #balanceCheckForm input').val()
			},
			'encoding': 'utf-8',
			'headers': {
				'Accept': 'application/json',
			},
		};

		var self = this;

		this.ajax(request, function(error, response, body) {
			$('.home-view #balanceCheckForm button').removeClass('is-loading');
			self.loading = false;

			if (error)
				return self.unableToCheckBalance();

			if (!response)
				return self.unableToCheckBalance();

			if (response.headers['content-type'] !== 'application/json')
				return self.unableToCheckBalance();

			var json;
			try {
				json = JSON.parse(body);
			} catch (error) {
				return self.unableToCheckBalance();
			}

			var parent = $('.home-view #balanceResult');
			var status, message;

			if (json.errors) {
				status = false;
				message = $.map(json.errors, function(item) { return item.join(' ') }).join(' ');
			} else {
				status = json.status;
				message = json.message;
			}


			$(parent).removeClass('is-success').removeClass('is-warning').addClass(status ? 'is-success' : 'is-warning').show();
			$('span', parent).text(message);
		});

		return false;
	}

	View.prototype.unableToCheckBalance = function()
	{
		var parent = $('.home-view #balanceResult');
		$(parent).removeClass('is-success').removeClass('is-warning').addClass('is-danger').show();
		$('span', parent).text('Unable to check address balance.');
	}

	module.exports = View;
})(this);
