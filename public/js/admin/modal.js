(function ($) {
    $.fn.modal = function (params) {
        let self = this;
        let config = {};

        //スクロール禁止
        let preventScroll = {
            x: 0,
            y: 0,
            setPos: function setPos() {
                var x =
                    arguments.length > 0 && arguments[0] !== undefined
                        ? arguments[0]
                        : window.pageXOffset;
                var y =
                    arguments.length > 1 && arguments[1] !== undefined
                        ? arguments[1]
                        : window.pageYOffset;
                this.x = x;
                this.y = y;
            },
            handleEvent: function handleEvent() {
                window.scrollTo(this.x, this.y);
            },
            enable: function enable() {
                this.setPos();
                window.addEventListener("scroll", this);
            },
            disable: function disable() {
                window.removeEventListener("scroll", this);
            }
        };

        let scrollPosition = 1;

        const modal = function () {
            scrollPosition = $(window).scrollTop();
            $(this).blur(); //ボタンからフォーカスを外す

            if (config.bg === true) {
                $("body").append('<div id="modal-overlay"></div>');
                $("#modal-overlay").fadeIn("slow");
            }

            if (config.title) {
                self.find(".modal-title").html(config.title);
            }

            if (config.scroll === true) {
                if (window.innerWidth > 767) {
                    preventScroll.enable(); //有効化
                } else {
                    $("body")
                        .addClass("body-fix")
                        .css({
                            top: -scrollPosition
                        });
                    $(".wrapper").css("overflow", "hidden");
                }
            }
            self.fadeIn("slow");

            if (config.customize !== false) {
                config.customize.call(self);
            }

            if (typeof config.customizeClose === "string") {
                $(config.customizeClose).on("click", function () {
                    closeModal();
                })
            }
        };

        const closeModal = function () {
            if (config.bg === true) {
                $("#modal-overlay").fadeOut("slow");
            }
            self.fadeOut("slow", function () {
                if (config.bg === true) {
                    $("#modal-overlay").remove();
                }
                if (config.scroll === true) {
                    if (window.innerWidth > 767) {
                        preventScroll.disable(); //無効化
                    } else {
                        $("body")
                            .removeClass("body-fix")
                            .css({ top: 0 });
                        window.scrollTo(0, scrollPosition);
                        $(".wrapper").css("overflow", "scroll");
                    }
                }
            });
        };

        if (params == "close") {
            closeModal();
            return this;
        }

        //個別の設定
        let option = {
            title: "",
            //スクロールを止めるか
            scroll: false,
            //背景の設定
            bg: true,
            //関数の実行　有の場合はcustomize: customize = function() {}
            customize: false,
            //カスタマイズのclose
            customizeClose: "",
            //閉じるに使用する項目
            closeBtn: "#modal-overlay,.modal-close,.modal-close,.no"
        };

        config = $.extend({}, option, params);

        $(config.closeBtn).on("click", closeModal);
        modal();

        return this;
    };

    $.commonModal = function (option) {
        var elem = $(".common-alert-modal");
        //個別の設定
        let def = {
            title: "",
            //閉じるに使用する項目
            closeBtn: "#modal-overlay,.modal-close,.yes,.no",
            //中身のテキスト
            content: "",
            //ボタンテキスト
            button: "",
        };

        if (typeof option.title != 'string') {
            console.error('title is not string');
            return;
        }
        if (option.content == "") {
            console.error('content is undefined');
            return;
        }

        option.button = option.button || 'はい';

        option = $.extend({}, def, option);

        elem.find(".common-alert-title").text(option.title);
        elem.find(".common-alert-content").html(option.content);
        elem.find(".common-alert-button").text(option.button);

        elem.modal(option);
    };
})(jQuery);

/* //削除モーダル
$(".delete-btn").on("click", function() {
    $(this).modal({
        modalName: ".modal-content.delete"
        }
    });
}); */

/* //削除モーダル
$(".delete-btn").on("click", function() {
    modalOpen(".modal-content.delete");
});
$(closeKick).on("click", function() {
    modalClose(".modal-content.delete");
});

//ステータスモーダル
$(".chose-color").on("click", function() {
    $(".chose-color").removeClass("active");
    $(this).addClass("active");
    modalOpen(".modal-content.modal-color");
});

$(".modal-color li").on("click", function() {
    const colorClass = $(this).attr("class");
    $(".chose-color.active input").val(colorClass);
    $(".chose-color.active")
        .removeClass()
        .addClass("chose-color")
        .addClass(colorClass);
    modalClose(".modal-content.modal-color");
});

$(closeKick).on("click", function() {
    modalClose(".modal-content.modal-color");
}); */
