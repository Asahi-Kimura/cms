// JavaScript Document
function showLoading() {
    $(".loading-block").show();
}
function hideLoading() {
    $(".loading-block").hide();
}
/* スクロール禁止 */
function noScroll(event) {
    event.preventDefault();
}
$(function () {
    //共通サイドバー
    $(".humberger").on("click", function () {
        //pc
        if (window.innerWidth > 959) {
            if ($(".side-contents").hasClass("active")) {
                $(".side-contents").removeClass("active");
                $(".main-contents").addClass("active");
                $(".side-nav").fadeIn(500);
            } else {
                $(".side-contents").addClass("active");
                $(".main-contents").removeClass("active");
                $(".side-nav").fadeOut(0);
            }
            //タブレット以下
        } else {
            if ($(".side-contents").hasClass("active")) {
                $(".side-contents").removeClass("active");
                $(".side-nav").fadeIn(500);
                document.removeEventListener('touchmove', noScroll, { passive: false });
                document.removeEventListener('mousewheel', noScroll, { passive: false });
            } else {
                $(".side-contents").addClass("active");
                document.addEventListener('touchmove', noScroll, { passive: false });
                document.addEventListener('mousewheel', noScroll, { passive: false });
            }
        }
    });

    //共通サイドバー、アコーディオン
    $(".main-category h4").on("click", function () {
        if (window.innerWidth > 959) {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this)
                    .next(".sub-category")
                    .slideUp();
            } else {
                $(this)
                    .next(".sub-category")
                    .slideDown();
                $(this).addClass("active");
            }
        }
    });

    //保存時の完了コメント
    setTimeout(function () {
        $(".alert-success,.alert-error")
            .fadeOut(300)
            .queue(function () {
                this.remove();
            });
    }, 2000);
    $(document).on("click", function () {
        if ($(".alert-success,.alert-error").length) {
            $(".alert-success,.alert-error").remove();
        }
    });

    //headerのログアウト表示
    $(".user-info").on("click", function () {
        if ($(".global-header").hasClass("active")) {
            $(".global-header").removeClass("active");
        } else {
            $(".global-header").addClass("active");
        }
    });

    //処理を二回走らせないため
    $(".checkChildTd input").on("click", function () {
        return false;
    });

    const checkBtn = $(".checkChild");
    const checkAllBtn = $(".checkAll");
    //チェックの親要素のクリックで子要素クリック
    $(".checkAllTh").on("click", function () {
        if (
            $(this)
                .find("input")
                .prop("checked")
        ) {
            checkAllBtn.prop("checked", false);
            checkBtn.prop("checked", false);
        } else {
            checkAllBtn.prop("checked", true);
            checkBtn.prop("checked", true);
        }
    });

    const checkfunc = function () {
        if (checkBtn.not(checkAllBtn).not(":checked").length === 0) {
            // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
            checkAllBtn.prop("checked", true);
        } else {
            // 1つでもチェックが入っていたら、「全選択」 = checked
            checkAllBtn.prop("checked", false);
        }
    };

    $(document).on("click", ".checkChildTd", function () {
        if (
            $(this)
                .find("input")
                .prop("checked")
        ) {
            $(this)
                .find("input")
                .prop("checked", false);
            checkfunc();
        } else {
            $(this)
                .find("input")
                .prop("checked", true);
            checkfunc();
        }
    });

    //ツールチップ
    if (window.innerWidth > 959) {
        $(".tooltip").tooltip({
            show: { effect: "fade", duration: 200 },
            hide: false,
            position: {
                my: "center top+10",
                at: "center bottom"
            }
        });
    }


});
$(function () {
    $('form').submit(function () {
        $(this).find(':submit').prop('disabled', 'true');
    });
});
