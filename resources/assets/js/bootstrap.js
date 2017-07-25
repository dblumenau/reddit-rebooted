
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
'use strict';

function cancelEvent (event) {
    event = event || window.event;
    if (event) {
        event = event.originalEvent || event;

        if (event.stopPropagation) event.stopPropagation();
        if (event.preventDefault) event.preventDefault();
    }

    return false;
}

function getGuid() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
        var r = Math.random()*16|0, v = c == 'x' ? r : (r&0x3|0x8);
        return v.toString(16);
    });
}

//ConfigStorage
(function(window)
{
    var keyPrefix = '';
    var noPrefix = false;
    var cache = {};
    var useCs = !!(window.chrome && chrome.storage && chrome.storage.local);
    var useLs = !useCs && !!window.localStorage;

    function storageSetPrefix(newPrefix)
    {
        keyPrefix = newPrefix;
    }

    function storageSetNoPrefix()
    {
        noPrefix = true;
    }

    function storageGetPrefix()
    {
        if (noPrefix)
        {
            noPrefix = false;
            return '';
        }
        return keyPrefix;
    }

    function storageGetValue()
    {
        var keys = Array.prototype.slice.call(arguments),
            callback = keys.pop(),
            result = [],
            single = keys.length == 1,
            value,
            allFound = true,
            prefix = storageGetPrefix(),
            i, key;

        for (i = 0; i < keys.length; i++)
        {
            key = keys[i] = prefix + keys[i];
            if (key.substr(0, 3) != 'xt_' && cache[key] !== undefined)
            {
                result.push(cache[key]);
            }
            else if (useLs)
            {
                try
                {
                    value = localStorage.getItem(key);
                }
                catch (e)
                {
                    useLs = false;
                }
                try
                {
                    value = (value === undefined || value === null) ? false : JSON.parse(value);
                }
                catch (e)
                {
                    value = false;
                }
                result.push(cache[key] = value);
            }
            else if (!useCs)
            {
                result.push(cache[key] = false);
            }
            else
            {
                allFound = false;
            }
        }

        if (allFound)
        {
            return callback(single ? result[0] : result);
        }

        chrome.storage.local.get(keys, function(resultObj)
        {
            var value;
            result = [];
            for (i = 0; i < keys.length; i++)
            {
                key = keys[i];
                value = resultObj[key];
                value = value === undefined || value === null ? false : JSON.parse(value);
                result.push(cache[key] = value);
            }

            callback(single ? result[0] : result);
        });
    };

    function storageSetValue(obj, callback)
    {
        var keyValues = {},
            prefix = storageGetPrefix(),
            key, value;

        for (key in obj)
        {
            if (obj.hasOwnProperty(key))
            {
                value = obj[key];
                key = prefix + key;
                cache[key] = value;
                value = JSON.stringify(value);
                if (useLs)
                {
                    try
                    {
                        localStorage.setItem(key, value);
                    }
                    catch (e)
                    {
                        useLs = false;
                    }
                }
                else
                {
                    keyValues[key] = value;
                }
            }
        }

        if (useLs || !useCs)
        {
            if (callback)
            {
                callback();
            }
            return;
        }

        chrome.storage.local.set(keyValues, callback);
    };

    function storageRemoveValue()
    {
        var keys = Array.prototype.slice.call(arguments),
            prefix = storageGetPrefix(),
            i, key, callback;

        if (typeof keys[keys.length - 1] === 'function')
        {
            callback = keys.pop();
        }

        for (i = 0; i < keys.length; i++)
        {
            key = keys[i] = prefix + keys[i];
            delete cache[key];
            if (useLs)
            {
                try
                {
                    localStorage.removeItem(key);
                }
                catch (e)
                {
                    useLs = false;
                }
            }
        }
        if (useCs)
        {
            chrome.storage.local.remove(keys, callback);
        }
        else if (callback)
        {
            callback();
        }
    };

    window.ConfigStorage = {
        prefix: storageSetPrefix,
        noPrefix: storageSetNoPrefix,
        get: storageGetValue,
        set: storageSetValue,
        remove: storageRemoveValue
    };
})(this);

// Pollyfill for IE 9 support of CustomEvent
(function () {

    if ( typeof window.CustomEvent === "function" ) return false;

    function CustomEvent ( event, params ) {
        params = params || { bubbles: false, cancelable: false, detail: undefined };
        var evt = document.createEvent( 'CustomEvent' );
        evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
        return evt;
    }

    CustomEvent.prototype = window.Event.prototype;

    window.CustomEvent = CustomEvent;
})();
