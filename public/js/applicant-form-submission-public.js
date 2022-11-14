(function ($) {
    'use strict';

    /**
     * All of the code for your public-facing JavaScript source
     * should reside in this file.
     *
     * Note: It has been assumed you will write jQuery code here, so the
     * $ function reference has been prepared for usage within the scope
     * of this function.
     *
     * This enables you to define handlers, for when the DOM is ready:
     *
     * $(function() {
     *
     * });
     *
     * When the window is loaded:
     *
     * $( window ).load(function() {
     *
     * });
     *
     * ...and/or other possibilities.
     *
     * Ideally, it is not considered best practise to attach more than a
     * single DOM-ready or window-load handler for a particular page.
     * Although scripts in the WordPress core, Plugins and Themes may be
     * practising this, we should strive to set a better example in our own work.
     */
    window.AFS = {
        el: {
            window: $(window),
            document: $(document),
        },
        fn: {},
        run: function () {
            AFS.el.document.ready(function () {
                AFS.el.document.on(
                    "click",
                    ".afs-btn-submit",
                    function (e) {
						e.preventDefault();
						var $this = $(this);
                        $this.attr("disable", "disable");
                        $this.toggleClass("afs-button--loading");
                        var form_data = $("form.afs-form-submission").serializeArray();
                        console.log($(".afs-cv").prop('files')[0]);
                        var file_name = "";
                        if(typeof  $(".afs-cv").prop('files')[0] !=="undefined"){
                            file_name = $(".afs-cv").prop('files')[0].name;
                        }

                        form_data.push({
                                name: "action", value: "afs_submission_submit",
                            },
							{
								name: "cv", value: file_name,
							}
                        );

						// var form_data = new FormData(this);
						// form_data.append('file', file_data);
						// form_data.append('action', 'afs_submission_submit');
						// form_data.append('nonce', afs_helper.admin_nonce);
						// console.log(form_data);
                        $.ajax({
                            url: afs_helper.ajaxurl,
                            method: "POST",
                            data: form_data,
							// contentType: false,
							// cache: false,
							// processData:false,
                            dataType: "json",
                        }).done(function (response) {
                            var msg = '';
                            if (typeof response.data !== "undefined") {
                                msg = response.data.msg;
                            } else {
                                msg = response.msg;
                            }
                            if (response.success) {
                                $this.removeAttr("disable", "disable");
                                $this.toggleClass("afs-button--loading");
                                $(".afs-form-submission").slideUp();
                                $(".afs-alert").html(msg);
                                $(".afs-alert").removeClass("afs-error");
                                $(".afs-alert").addClass("afs-pesan");
                            } else {
                                $this.removeAttr("disable", "disable");
                                $this.toggleClass("afs-button--loading");
                                $(".afs-alert").html(msg);
                                $(".afs-alert").removeClass("afs-pesan");
                                $(".afs-alert").addClass("afs-error");
                            }
                        }).fail(function (jqXHR, textStatus, error) {
                            $this.removeAttr("disable", "disable");
                            $this.toggleClass("afs-button--loading");
                            if (typeof jqXHR.responseText != "undefined") {
                                $(".afs-alert").html(afs_helper.error_nonce);
                                $(".afs-alert").removeClass("afs-pesan");
                                $(".afs-alert").addClass("afs-error");
                            }
                            if (typeof jqXHR.responseJSON != "undefined") {
                                if (typeof jqXHR.responseJSON.message != "undefined") {
                                    $(".afs-alert").html(jqXHR.responseJSON.message);
                                    $(".afs-alert").removeClass("afs-pesan");
                                    $(".afs-alert").addClass("afs-error");
                                }
                            }
                        });
                    }
                );
            });
        },
    };
    AFS.run();
})(jQuery);
