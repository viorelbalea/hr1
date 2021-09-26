/**
 * jQuery custom selectboxes
 *
 * Copyright (c) 2008 Krzysztof Suszyński (suszynski.org)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 *
 * @version 0.6.1
 * @category visual
 * @package jquery
 * @subpakage ui.selectbox
 * @author Krzysztof Suszyński <k.suszynski@wit.edu.pl>
 **/
(function ($) {
    $.fn.selectbox = function (options) {
        /* Default settings */
        var settings = {
            className: 'jquery-selectbox',
            animationSpeed: "normal",
            listboxMaxSize: 10,
            replaceInvisible: false
        };
        var commonClass = 'jquery-custom-selectboxes-replaced';
        var listOpen = false;
        var showList = function (listObj) {
            var selectbox = listObj.parents('.' + settings.className + '');
            listObj.slideDown(settings.animationSpeed, function () {
                listOpen = true;
            });
            selectbox.addClass('selecthover');
            $(document).bind('click', onBlurList);
            return listObj;
        }
        var hideList = function (listObj) {
            var selectbox = listObj.parents('.' + settings.className + '');
            listObj.slideUp(settings.animationSpeed, function () {
                listOpen = false;
                $(this).parents('.' + settings.className + '').removeClass('selecthover');
            });
            $(document).unbind('click', onBlurList);
            return listObj;
        }
        var onBlurList = function (e) {
            var trgt = e.target;
            var currentListElements = $('.' + settings.className + '-list:visible').parent().find('*').andSelf();
            if ($.inArray(trgt, currentListElements) < 0 && listOpen) {
                hideList($('.' + commonClass + '-list'));
            }
            return false;
        }

        /* Processing settings */
        settings = $.extend(settings, options || {});
        /* Wrapping all passed elements */
        return this.each(function () {
            var _this = $(this);
            if (_this.filter(':visible').length == 0 && !settings.replaceInvisible)
                return;
            var replacement = $(
                '<div class="' + settings.className + ' ' + commonClass + '">' +
                    '<div class="' + settings.className + '-moreButton" >˅</div>' +
                    '<div class="' + settings.className + '-list ' + commonClass + '-list" />' +
                    '<span class="' + settings.className + '-currentItem" />' +
                    '</div>'
            );
            $('option', _this).each(function (k, v) {
                var v = $(v);
                var listElement = $('<span class="' + settings.className + '-item value-' + v.val() + ' item-' + k + '">' + v.text() + '</span>');
                listElement.click(function () {
                    var thisListElement = $(this);
                    var thisReplacment = thisListElement.parents('.' + settings.className);
                    var thisIndex = thisListElement[0].className.split(' ');
                    for (k1 in thisIndex) {
                        if (/^item-[0-9]+$/.test(thisIndex[k1])) {
                            thisIndex = parseInt(thisIndex[k1].replace('item-', ''), 10);
                            break;
                        }
                    }
                    ;
                    var thisValue = thisListElement[0].className.split(' ');
                    for (k1 in thisValue) {
                        if (/^value-.+$/.test(thisValue[k1])) {
                            thisValue = thisValue[k1].replace('value-', '');
                            break;
                        }
                    }
                    ;
                    thisReplacment
                        .find('.' + settings.className + '-currentItem')
                        .text(thisListElement.text());
                    thisReplacment
                        .find('select')
                        .val(thisValue)
                        .triggerHandler('change');
                    var thisSublist = thisReplacment.find('.' + settings.className + '-list');
                    if (thisSublist.filter(":visible").length > 0) {
                        hideList(thisSublist);
                    } else {
                        showList(thisSublist);
                    }
                }).bind('mouseenter',function () {
                        $(this).addClass('listelementhover');
                    }).bind('mouseleave', function () {
                        $(this).removeClass('listelementhover');
                    });
                $('.' + settings.className + '-list', replacement).append(listElement);
                if (v.filter(':selected').length > 0) {
                    $('.' + settings.className + '-currentItem', replacement).text(v.text());
                }
            });
            replacement.find('.' + settings.className + '-moreButton').click(function () {
                var thisMoreButton = $(this);
                var otherLists = $('.' + settings.className + '-list')
                    .not(thisMoreButton.siblings('.' + settings.className + '-list'));
                hideList(otherLists);
                var thisList = thisMoreButton.siblings('.' + settings.className + '-list');
                if (thisList.filter(":visible").length > 0) {
                    hideList(thisList);
                } else {
                    showList(thisList);
                }
            }).bind('mouseenter',function () {
                    $(this).addClass('morebuttonhover');
                }).bind('mouseleave', function () {
                    $(this).removeClass('morebuttonhover');
                });
            _this.hide().replaceWith(replacement).appendTo(replacement);
            var thisListBox = replacement.find('.' + settings.className + '-list');
            var thisListBoxSize = thisListBox.find('.' + settings.className + '-item').length;
            if (thisListBoxSize > settings.listboxMaxSize)
                thisListBoxSize = settings.listboxMaxSize;
            if (thisListBoxSize == 0)
                thisListBoxSize = 1;
            var thisListBoxWidth = Math.round(_this.width() + 5);
            if ($.browser.safari)
                thisListBoxWidth = thisListBoxWidth * 0.94;
            replacement.css('width', thisListBoxWidth + 'px');
            thisListBox.css({
                width: Math.round(thisListBoxWidth - 5) + 'px',
                height: thisListBoxSize + 'em'
            });
        });
    }
    $.fn.unselectbox = function () {
        var commonClass = 'jquery-custom-selectboxes-replaced';
        return this.each(function () {
            var selectToRemove = $(this).filter('.' + commonClass);
            selectToRemove.replaceWith(selectToRemove.find('select').show());
        });
    }
})(jQuery);