<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Etude Music Centre</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
	<link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/img/icon-etude.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url(); ?>assets/img/icon-etude.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url(); ?>assets/img/icon-etude.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url(); ?>assets/img/icon-etude.png">
	<style>
		/* ==== Google font ==== */
		@import url('http://fonts.googleapis.com/css?family=Lato:400,300,700,900');

		body {
			background: #394864;
			font-family: 'Lato', sans-serif;
			font-weight: 300;
			font-size: 14px;
			color: #555;
			line-height: 1.6em;
			-webkit-font-smoothing: antialiased;
			-webkit-overflow-scrolling: touch;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: 'Lato', sans-serif;
			font-weight: 300;
			color: #444;
		}

		h1 {
			font-size: 40px;
		}

		h3 {
			font-weight: 400;
		}

		h4 {
			font-weight: 400;
			font-size: 20px;
		}

		p {
			margin-bottom: 20px;
			font-size: 16px;
		}


		a {
			color: #ACBAC1;
			word-wrap: break-word;
			-webkit-transition: color 0.1s ease-in, background 0.1s ease-in;
			-moz-transition: color 0.1s ease-in, background 0.1s ease-in;
			-ms-transition: color 0.1s ease-in, background 0.1s ease-in;
			-o-transition: color 0.1s ease-in, background 0.1s ease-in;
			transition: color 0.1s ease-in, background 0.1s ease-in;
		}

		a:hover,
		a:focus {
			color: #4F92AF;
			text-decoration: none;
			outline: 0;
		}

		a:before,
		a:after {
			-webkit-transition: color 0.1s ease-in, background 0.1s ease-in;
			-moz-transition: color 0.1s ease-in, background 0.1s ease-in;
			-ms-transition: color 0.1s ease-in, background 0.1s ease-in;
			-o-transition: color 0.1s ease-in, background 0.1s ease-in;
			transition: color 0.1s ease-in, background 0.1s ease-in;
		}

		.alignleft {
			text-align: left;
		}

		.alignright {
			text-align: right;
		}

		.aligncenter {
			text-align: center;
		}

		.btn {
			display: inline-block;
			padding: 10px 20px;
			margin-bottom: 0;
			font-size: 14px;
			font-weight: normal;
			line-height: 1.428571429;
			text-align: center;
			white-space: nowrap;
			vertical-align: middle;
			cursor: pointer;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			-o-user-select: none;
			user-select: none;
			background-image: none;
			border: 1px solid transparent;
			border-radius: 0;
		}

		.btn-theme {
			color: #fff;
			background-color: #4F92AF;
			border-color: #4F92AF;
		}

		.btn-theme:hover {
			color: #fff;
			background-color: #444;
			border-color: #444;
		}

		form.signup input {
			height: 42px;
			width: 200px;
			border-radius: 0;
			border: none;
		}

		form.signup button.btn {
			font-weight: 700;
		}

		form.signup input.form-control:focus {
			border-color: #fd680e;
		}


		/* wrapper */

		#wrapper {
			text-align: center;
			padding: 50px 0;
			background: url(../img/main-bg.jpg) no-repeat center top;
			background-attachment: relative;
			background-position: center center;
			min-height: 650px;
			width: 100%;
			-webkit-background-size: 100%;
			-moz-background-size: 100%;
			-o-background-size: 100%;
			background-size: 100%;

			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}



		#wrapper h1 {
			margin-top: 60px;
			margin-bottom: 40px;
			color: #fff;
			font-size: 45px;
			font-weight: 900;
			letter-spacing: -1px;
		}

		h2.subtitle {
			color: #fff;
			font-size: 24px;
		}

		/* countdown */
		#countdown {
			font-size: 30px;
			color: #fff;
			line-height: 1.1em;
			margin: 40px 0 60px;
		}


		/* footer */
		p.copyright {
			margin-top: 50px;
			color: #fff;
			text-align: center;
		}
	</style>
</head>

<body>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12">
					<h1>Coming Soon</h1>
					<img class="w-50" src="<?= base_url(); ?>assets/img/logo.png">
					<div class="" id="countdown"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="copyright">Copyright © 2020 - Etude</p>
				</div>
			</div>
		</div>
	</div>
	<script src="<?= base_url('assets/js/jquery-3.4.0.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/popper.js'); ?>" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
	<script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script>
		$(document).ready(function() {
			$('#countdown').countdown('2021/01/01', function(event) {
				$(this).html(event.strftime('%w weeks %d days <br /> %H:%M:%S'));
			});
		});

		! function(a) {
			"function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
		}(function(a) {
			"use strict";

			function b(a) {
				if (a instanceof Date) return a;
				if (String(a).match(g)) return String(a).match(/^[0-9]*$/) && (a = Number(a)), new Date(a);
				throw new Error("Couldn't cast `" + a + "` to a date object.")
			}

			function c(a) {
				return function(b) {
					var c = b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);
					if (c)
						for (var e = 0, f = c.length; f > e; ++e) {
							var g = c[e].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),
								i = new RegExp(g[0]),
								j = g[1] || "",
								k = g[3] || "",
								l = null;
							g = g[2], h.hasOwnProperty(g) && (l = h[g], l = Number(a[l])), null !== l && ("!" === j && (l = d(k, l)), "" === j && 10 > l && (l = "0" + l.toString()), b = b.replace(i, l.toString()))
						}
					return b = b.replace(/%%/, "%")
				}
			}

			function d(a, b) {
				var c = "s",
					d = "";
				return a && (a = a.replace(/(:|;|\s)/gi, "").split(/\,/), 1 === a.length ? c = a[0] : (d = a[0], c = a[1])), 1 === Math.abs(b) ? d : c
			}
			var e = 100,
				f = [],
				g = [];
			g.push(/^[0-9]*$/.source), g.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g.push(/[0-9]{4}(\/[0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source), g = new RegExp(g.join("|"));
			var h = {
					Y: "years",
					m: "months",
					w: "weeks",
					d: "days",
					D: "totalDays",
					H: "hours",
					M: "minutes",
					S: "seconds"
				},
				i = function(b, c, d) {
					this.el = b, this.$el = a(b), this.interval = null, this.offset = {}, this.setFinalDate(c), this.instanceNumber = f.length, f.push(this), this.$el.data("countdown-instance", this.instanceNumber), d && (this.$el.on("update.countdown", d), this.$el.on("stoped.countdown", d), this.$el.on("finish.countdown", d)), this.start()
				};
			a.extend(i.prototype, {
				start: function() {
					if (null !== this.interval) throw new Error("Countdown is already running!");
					var a = this;
					this.update(), this.interval = setInterval(function() {
						a.update.call(a)
					}, e)
				},
				stop: function() {
					clearInterval(this.interval), this.interval = null, this.dispatchEvent("stoped")
				},
				pause: function() {
					this.stop.call(this)
				},
				resume: function() {
					this.start.call(this)
				},
				remove: function() {
					this.stop(), delete f[this.instanceNumber]
				},
				setFinalDate: function(a) {
					this.finalDate = b(a)
				},
				update: function() {
					return 0 === this.$el.closest("html").length ? (this.remove(), void 0) : (this.totalSecsLeft = this.finalDate.valueOf() - (new Date).valueOf(), this.totalSecsLeft = Math.ceil(this.totalSecsLeft / 1e3), this.totalSecsLeft = this.totalSecsLeft < 0 ? 0 : this.totalSecsLeft, this.offset = {
						seconds: this.totalSecsLeft % 60,
						minutes: Math.floor(this.totalSecsLeft / 60) % 60,
						hours: Math.floor(this.totalSecsLeft / 60 / 60) % 24,
						days: Math.floor(this.totalSecsLeft / 60 / 60 / 24) % 7,
						totalDays: Math.floor(this.totalSecsLeft / 60 / 60 / 24),
						weeks: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 7),
						months: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 30),
						years: Math.floor(this.totalSecsLeft / 60 / 60 / 24 / 365)
					}, 0 === this.totalSecsLeft ? (this.stop(), this.dispatchEvent("finish")) : this.dispatchEvent("update"), void 0)
				},
				dispatchEvent: function(b) {
					var d = a.Event(b + ".countdown");
					d.finalDate = this.finalDate, d.offset = a.extend({}, this.offset), d.strftime = c(this.offset), this.$el.trigger(d)
				}
			}), a.fn.countdown = function() {
				var b = Array.prototype.slice.call(arguments, 0);
				return this.each(function() {
					var c = a(this).data("countdown-instance");
					if (void 0 !== c) {
						var d = f[c],
							e = b[0];
						i.prototype.hasOwnProperty(e) ? d[e].apply(d, b.slice(1)) : null === String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i) ? d.setFinalDate.call(d, e) : a.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi, e))
					} else new i(this, b[0], b[1])
				})
			}
		});
	</script>
</body>

</html>