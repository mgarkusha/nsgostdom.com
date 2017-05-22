(function ($) {
	$(function () {
		var $frmCreateBooking = $('#frmCreateBooking'),
			$frmUpdateBooking = $('#frmUpdateBooking'),
			$dialogDelete = $("#dialogDelete"),
			$dialogContact = $("#dialogContact");
		
		var sh = {
			submitHandler: function (form) {
				checkAvailability.apply(null, [$(form), function (data) {
					if (callbackAvailability(data)) {
						form.submit();
					}
				}]);
			}
		};
		
		if ($frmCreateBooking.length > 0) {
			$frmCreateBooking.validate(sh);
		}
		if ($frmUpdateBooking.length > 0) {
			$frmUpdateBooking.validate(sh);
			getPrice($frmUpdateBooking);
		}

		if ($dialogDelete.length > 0) {
			$dialogDelete.dialog({
				autoOpen: false,
				resizable: false,
				draggable: false,
				height:220,
				modal: true,
				buttons: {
					'Удалить': function() {
						$.ajax({
							type: "POST",
							data: {
								id: $(this).data("id")
							},
							url: "index.php?controller=AdminBookings&action=delete",
							success: function (res) {
								$("#content").html(res);
							}
						});
						$(this).dialog('close');			
					},
					'Отмена': function() {
						$(this).dialog('close');
					}
				}
			});
		}
		
		if ($dialogContact.length > 0) {
			$dialogContact.dialog({
				autoOpen: false,
				resizable: false,
				draggable: false,
				width: 600,
				height: 400,
				modal: true,
				open: function () {
					var $this = $(this);
					$.getJSON("index.php?controller=AdminBookings&action=getContact", {
						id: $this.data("id")
					}).success(function (data) {
						if (!data.code) return;
						switch (parseInt(data.code, 10)) {
							case 200:
								$("#to").val(data.to);
								$("#subject").val(data.subject);
								$("#body").val(data.body);
								break;
						}
					});
				},
				close: function () {
					$(":input", $(this)).val("");
				},
				buttons: {
					'Отправить': function() {
						$.post("index.php?controller=AdminBookings&action=contact", $("#dialogContact form").serialize()).success(function (data) {
							
						});
						$(this).dialog('close');			
					},
					'Отмена': function() {
						$(this).dialog('close');
					}
				}
			});
		}
		
		$("#content").delegate("#booking_room_id", "change", function (e) {
			var val = $("option:selected", $(this)).val();
			window.location.href = "index.php?controller=AdminBookings&action=calendar&room_id=" + val;
		}).delegate(".calendarLinkMonth", "click", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var rel = $(this).attr("rel");
			$.get("index.php?controller=AdminBookings&action=getCalendar", {
				room_id: rel.split("-")[0],
				month: rel.split("-")[1],
				year: rel.split("-")[2]
			}).success(function(data) {
				$("#boxCalendar").html(data);
			});
			return false;
		}).delegate(".icon-email", "click", function(e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$("#dialogContact").data("id", $(this).attr('rel')).dialog('open');
			return false;
		}).delegate("#btnAddRoom", "click", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			var clone = $("#boxRoomClone").clone(),
				index = parseInt($("#boxRooms p").length, 10) + 2,
				h = clone.html().replace(/\{INDEX\}/g, index);
			clone = $(h);
			clone.appendTo("#boxRooms");
			return false;
		}).delegate("#btnCheckAvail", "click", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			checkAvailability.apply(null, [$(this).closest("form"), function (data) {
				callbackAvailability(data);
			}]);
			return false;
		}).delegate(".btnRemoveRoom", "click", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$form = $(this).closest("form");
			$(this).parent().remove();
			setPrice($form);
			return false;
		}).delegate(":input[name='room_id[]'], :input[name='adults[]'], :input[name='children[]']", "change", function () {
			getPrice($(this).closest('form'));
		}).delegate("#payment_method", "change", function () {
			if ($("option:selected", this).val() == 'creditcard') {
				$(".boxCC").show();
			} else {
				$(".boxCC").hide();
			}
		}).delegate("input[name^='extra_id']", "change", function () {
			setPrice($(this).closest("form"));
		}).delegate("a.icon-delete", "click", function (e) {
			if (e && e.preventDefault) {
				e.preventDefault();
			}
			$('#dialogDelete').data("id", $(this).attr('rel')).dialog('open');
			return false;
		});
		
		function checkAvailability($frm, callback) {
			$.post("index.php?controller=AdminBookings&action=checkAvailability", $frm.serialize()).done(function (data) {
				callback(data);
			});
		}
		
		function callbackAvailability(data) {
			if (!data.status) {
				return false;
			}
			var t = [],
				$box = $("#boxStatusAvail");
			switch (parseInt(data.status, 10)) {
				case 200:
					$box.css({"color":"green"}).html('<label class="title">&nbsp;</label>' + data.text).show();
					return true;
					break;
				case 100:
					t.push( data.text );
					break;
				default:
					for (var x in data.rooms) {
						if (data.rooms.hasOwnProperty(x) && data.rooms[x].code != 200) {
							t.push( x + ": " + data.rooms[x].text );
						}
					}
					break;
			}
			$box.css({"color":"red"}).html('<label class="title">&nbsp;</label>' + t.join('<br>')).show();
			return false;
		}
		
		var $datepick = $(".datepick"),
			$datepicking = $(".datepicking"),
			dpOpt = {
				showOn: "both",
				buttonImage: "app/web/img/backend/calendar.png",
				buttonImageOnly: true
			};
		if ($datepick.length > 0) {
			$datepick.datepicker($.extend(dpOpt, {
				//dateFormat: $datepick.attr("rev"),
				onSelect: function (dateText, inst) {
					if (inst.id == 'from') {
						$("#to").datepicker("option", "minDate", dateText);
					}
				}
			}));
		}
		if ($datepicking.length > 0) {
			$datepicking.datepicker($.extend(dpOpt, {
				//dateFormat: $datepicking.attr("rev"),
				onSelect: function (dateText, inst) {
					//getPrice(inst.input.closest('form'));
					if (inst.id == 'from') {
						$("#to").datepicker("option", "minDate", dateText);
					}
				}
			}));
		}
		
		function getPrice($form) {
			$.post("index.php?controller=AdminBookings&action=getPrice", $form.serialize()).success(function (data) {
				for (var i = 0, len = data.length; i < len; i++) {
					$("span.price").eq(i).html(data[i].format);
				}
				setPrice($form);
			});
		}

		function setPrice($form) {
			$.post("index.php?controller=AdminBookings&action=setPrice", $form.serialize()).success(function (data) {
				$("#tax").val(data.tax);
				$("#total").val(data.total);
				$("#deposit").val(data.deposit);
			});
		}
	});
})(jQuery);