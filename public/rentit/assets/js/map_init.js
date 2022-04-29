function d(a) {
    return function (b) {
        this[a] = b
    }
}
function f(a) {
    return function () {
        return this[a]
    }
}
var h;
function i(a, b, c) {
    this.extend(i, google.maps.OverlayView);
    this.b = a;
    this.a = [];
    this.l = [];
    this.V = [53, 56, 66, 78, 90];
    this.j = [];
    this.v = false;
    c = c || {};
    this.f = c.gridSize || 60;
    this.R = c.maxZoom || null;
    this.j = c.styles || [];
    this.Q = c.imagePath || this.J;
    this.P = c.imageExtension || this.I;
    this.W = c.zoomOnClick || true;
    l(this);
    this.setMap(a);
    this.D = this.b.getZoom();
    var e = this;
    google.maps.event.addListener(this.b, "zoom_changed", function () {
        var g = e.b.mapTypes[e.b.getMapTypeId()].maxZoom, k = e.b.getZoom();
        if (!(k < 0 || k > g))if (e.D != k) {
            e.D = e.b.getZoom();
            e.m()
        }
    });
    google.maps.event.addListener(this.b, "bounds_changed", function () {
        e.i()
    });
    b && b.length && this.z(b, false)
}
h = i.prototype;
h.J = "http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/images/m";
h.I = "png";
h.extend = function (a, b) {
    return function (c) {
        for (property in c.prototype)this.prototype[property] = c.prototype[property];
        return this
    }.apply(a, [b])
};
h.onAdd = function () {
    if (!this.v) {
        this.v = true;
        m(this)
    }
};
h.O = function () {
};
h.draw = function () {
};
function l(a) {
    for (var b = 0, c; c = a.V[b]; b++)a.j.push({url: a.Q + (b + 1) + "." + a.P, height: c, width: c})
}
h = i.prototype;
h.u = f("j");
h.L = f("a");
h.N = f("a");
h.C = function () {
    return this.R || this.b.mapTypes[this.b.getMapTypeId()].maxZoom
};
h.A = function (a, b) {
    for (var c = 0, e = a.length, g = e; g !== 0;) {
        g = parseInt(g / 10, 10);
        c++
    }
    c = Math.min(c, b);
    return {text: e, index: c}
};
h.T = d("A");
h.B = f("A");
h.z = function (a, b) {
    for (var c = 0, e; e = a[c]; c++)n(this, e);
    b || this.i()
};
function n(a, b) {
    b.setVisible(false);
    b.setMap(null);
    b.q = false;
    b.draggable && google.maps.event.addListener(b, "dragend", function () {
        b.q = false;
        a.m();
        a.i()
    });
    a.a.push(b)
}
h = i.prototype;
h.o = function (a, b) {
    n(this, a);
    b || this.i()
};
h.S = function (a) {
    var b = -1;
    if (this.a.indexOf)b = this.a.indexOf(a); else for (var c = 0, e; e = this.a[c]; c++)if (e == a)b = c;
    if (b == -1)return false;
    this.a.splice(b, 1);
    a.setVisible(false);
    a.setMap(null);
    this.m();
    this.i();
    return true
};
h.M = function () {
    return this.l.length
};
h.getMap = f("b");
h.setMap = d("b");
h.t = f("f");
h.U = d("f");
function o(a, b) {
    var c = a.getProjection(), e = new google.maps.LatLng(b.getNorthEast().lat(), b.getNorthEast().lng()), g = new google.maps.LatLng(b.getSouthWest().lat(), b.getSouthWest().lng());
    e = c.fromLatLngToDivPixel(e);
    e.x += a.f;
    e.y -= a.f;
    g = c.fromLatLngToDivPixel(g);
    g.x -= a.f;
    g.y += a.f;
    e = c.fromDivPixelToLatLng(e);
    c = c.fromDivPixelToLatLng(g);
    b.extend(e);
    b.extend(c);
    return b
}
i.prototype.K = function () {
    this.m();
    this.a = []
};
i.prototype.m = function () {
    for (var a = 0, b; b = this.l[a]; a++)b.remove();
    for (a = 0; b = this.a[a]; a++) {
        b.q = false;
        b.setMap(null);
        b.setVisible(false)
    }
    this.l = []
};
i.prototype.i = function () {
    m(this)
};
function m(a) {
    if (a.v)for (var b = o(a, new google.maps.LatLngBounds(a.b.getBounds().getSouthWest(), a.b.getBounds().getNorthEast())), c = 0, e; e = a.a[c]; c++) {
        var g = false;
        if (!e.q && b.contains(e.getPosition())) {
            for (var k = 0, j; j = a.l[k]; k++)if (!g && j.getCenter() && j.s.contains(e.getPosition())) {
                g = true;
                j.o(e);
                break
            }
            if (!g) {
                j = new p(a);
                j.o(e);
                a.l.push(j)
            }
        }
    }
}
function p(a) {
    this.h = a;
    this.b = a.getMap();
    this.f = a.t();
    this.d = null;
    this.a = [];
    this.s = null;
    this.k = new q(this, a.u(), a.t())
}
p.prototype.o = function (a) {
    var b;
    a:if (this.a.indexOf)b = this.a.indexOf(a) != -1; else {
        b = 0;
        for (var c; c = this.a[b]; b++)if (c == a) {
            b = true;
            break a
        }
        b = false
    }
    if (b)return false;
    if (!this.d) {
        this.d = a.getPosition();
        r(this)
    }
    if (this.a.length == 0) {
        a.setMap(this.b);
        a.setVisible(true)
    } else if (this.a.length == 1) {
        this.a[0].setMap(null);
        this.a[0].setVisible(false)
    }
    a.q = true;
    this.a.push(a);
    if (this.b.getZoom() > this.h.C())for (a = 0; b = this.a[a]; a++) {
        b.setMap(this.b);
        b.setVisible(true)
    } else if (this.a.length < 2)s(this.k); else {
        a = this.h.u().length;
        b = this.h.B()(this.a, a);
        this.k.setCenter(this.d);
        a = this.k;
        a.w = b;
        a.ba = b.text;
        a.X = b.index;
        if (a.c)a.c.innerHTML = b.text;
        b = Math.max(0, a.w.index - 1);
        b = Math.min(a.j.length - 1, b);
        b = a.j[b];
        a.H = b.url;
        a.g = b.height;
        a.n = b.width;
        a.F = b.Z;
        a.anchor = b.Y;
        a.G = b.$;
        this.k.show()
    }
    return true
};
p.prototype.getBounds = function () {
    r(this);
    return this.s
};
p.prototype.remove = function () {
    this.k.remove();
    delete this.a
};
p.prototype.getCenter = f("d");
function r(a) {
    a.s = o(a.h, new google.maps.LatLngBounds(a.d, a.d))
}
p.prototype.getMap = f("b");
function q(a, b, c) {
    a.h.extend(q, google.maps.OverlayView);
    this.j = b;
    this.aa = c || 0;
    this.p = a;
    this.d = null;
    this.b = a.getMap();
    this.w = this.c = null;
    this.r = false;
    this.setMap(this.b)
}
q.prototype.onAdd = function () {
    this.c = document.createElement("DIV");
    if (this.r) {
        this.c.style.cssText = t(this, u(this, this.d));
        this.c.innerHTML = this.w.text
    }
    this.getPanes().overlayImage.appendChild(this.c);
    var a = this;
    google.maps.event.addDomListener(this.c, "click", function () {
        var b = a.p.h;
        google.maps.event.trigger(b, "clusterclick", [a.p]);
        if (b.W) {
            a.b.panTo(a.p.getCenter());
            a.b.fitBounds(a.p.getBounds())
        }
    })
};
function u(a, b) {
    var c = a.getProjection().fromLatLngToDivPixel(b);
    c.x -= parseInt(a.n / 2, 10);
    c.y -= parseInt(a.g / 2, 10);
    return c
}
q.prototype.draw = function () {
    if (this.r) {
        var a = u(this, this.d);
        this.c.style.top = a.y + "px";
        this.c.style.left = a.x + "px"
    }
};
function s(a) {
    if (a.c)a.c.style.display = "none";
    a.r = false
}
q.prototype.show = function () {
    if (this.c) {
        this.c.style.cssText = t(this, u(this, this.d));
        this.c.style.display = ""
    }
    this.r = true
};
q.prototype.remove = function () {
    this.setMap(null)
};
q.prototype.onRemove = function () {
    if (this.c && this.c.parentNode) {
        s(this);
        this.c.parentNode.removeChild(this.c);
        this.c = null
    }
};
q.prototype.setCenter = d("d");
function t(a, b) {
    var c = [];
    document.all ? c.push('filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale,src="' + a.H + '");') : c.push("background:url(" + a.H + ");");
    if (typeof a.e === "object") {
        typeof a.e[0] === "number" && a.e[0] > 0 && a.e[0] < a.g ? c.push("height:" + (a.g - a.e[0]) + "px; padding-top:" + a.e[0] + "px;") : c.push("height:" + a.g + "px; line-height:" + a.g + "px;");
        typeof a.e[1] === "number" && a.e[1] > 0 && a.e[1] < a.n ? c.push("width:" + (a.n - a.e[1]) + "px; padding-left:" + a.e[1] + "px;") : c.push("width:" + a.n + "px; text-align:center;")
    } else c.push("height:" + a.g + "px; line-height:" + a.g + "px; width:" + a.n + "px; text-align:center;");
    c.push("cursor:pointer; top:" + b.y + "px; left:" + b.x + "px; color:" + (a.F ? a.F : "black") + "; position:absolute; font-size:" + (a.G ? a.G : 11) + "px; font-family:Arial,sans-serif; font-weight:bold");
    return c.join("")
}
window.MarkerClusterer = i;
i.prototype.addMarker = i.prototype.o;
i.prototype.addMarkers = i.prototype.z;
i.prototype.clearMarkers = i.prototype.K;
i.prototype.getCalculator = i.prototype.B;
i.prototype.getGridSize = i.prototype.t;
i.prototype.getMap = i.prototype.getMap;
i.prototype.getMarkers = i.prototype.L;
i.prototype.getMaxZoom = i.prototype.C;
i.prototype.getStyles = i.prototype.u;
i.prototype.getTotalClusters = i.prototype.M;
i.prototype.getTotalMarkers = i.prototype.N;
i.prototype.redraw = i.prototype.i;
i.prototype.removeMarker = i.prototype.S;
i.prototype.resetViewport = i.prototype.m;
i.prototype.setCalculator = i.prototype.T;
i.prototype.setGridSize = i.prototype.U;
i.prototype.onAdd = i.prototype.onAdd;
i.prototype.draw = i.prototype.draw;
i.prototype.idle = i.prototype.O;
q.prototype.onAdd = q.prototype.onAdd;
q.prototype.draw = q.prototype.draw;
q.prototype.onRemove = q.prototype.onRemove;


(function (A) {

    if (!Array.prototype.forEach)
        A.forEach = A.forEach || function (action, that) {
            for (var i = 0, l = this.length; i < l; i++)
                if (i in this)
                    action.call(that, this[i], i, this);
        };

})(Array.prototype);


var global_scrollwheel = true;
var markerClusterer = null;
var markerCLuster;
var Clusterer;


var mapIWcontent = '';

var contentString = '' +
    '' +
    '<div class="iw-container">' +
    '<div class="iw-content">' +
    '' + mapIWcontent +
    '</div>' +
    '<div class="iw-bottom-gradient"></div>' +
    '</div>' +
    '' +
    '';


function initialize_new2() {
    var bounds = new google.maps.LatLngBounds();
    var mapOptions2 = {
        zoom: parseInt(rentit_obj.zum),
        minZoom: 3,
        center: new google.maps.LatLng(parseFloat(rentit_obj.lat), parseFloat(rentit_obj.longu)),
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },

        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT
        },
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        styles: rentit_obj.global_map_styles,//global_map_styles,
        //     zoomControl: false,
        //  scaleControl: false,
        //  scrollwheel: false,
        disableDoubleClickZoom: true,

    };

    var
        marker;

    console.log(mapOptions2);
    //mapObject = new google.maps.Map(document.getElementById('map-canvas'));




    mapObject = new google.maps.Map(document.getElementById("map-canvas"), mapOptions2);
    google.maps.event.addListener(mapObject, 'domready', function () {

    });
    google.maps.event.addListener(mapObject, 'click', function () {
        closeInfoBox();
    });
    var markerCluster;
    infowindow = new google.maps.InfoWindow({
        content: contentString
        , maxWidth: 350
        //,maxHeight: 500
    });
    var arr_url = [];
    for (var key in markersData) {
        markersData[key].forEach(function (item) {

            if (!in_array(item.url_point, arr_url)) {

                arr_url.push(item.url_point);

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                    map: mapObject,
                    icon: item.fa_icon //,
                });
                loc = new google.maps.LatLng(item.location_latitude, item.location_longitude);
                bounds.extend(loc);

                if ('undefined' === typeof markers[key])
                    markers[key] = [];
                markers[key].push(marker);
                google.maps.event.addListener(mapObject, 'click', function () {
                    closeInfoBox();
                });

                google.maps.event.addListener(marker, 'click', (function () {

                    closeInfoBox();
                    var icons = JSON.parse(item.icons);
                    var iconst_ob = '';
                    for (k in icons) {
                        iconst_ob +=   '<td><i class="fa '+ k +'"></i> ' + icons[k] +'</td>' ;
                    }

                    var mapIWcontent = '' +
                        '' +
                        '<div class="map-info-window">' +
                        '<div class="thumbnail no-border no-padding thumbnail-car-card">' +
                        '<div class="media">' +
                        '<a  class="media-link" href="' +  item.url_point  + '">' +
                        '<img style="max-width: 350px" src="' + item.map_image_url + '" alt=""/>' +
                        '<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>' +
                        '</a>' +
                        '</div>' +
                        '<div class="caption text-center">' +
                        '<h4 class="caption-title"><a href="' +
                        item.url_point + '">' + item.name_point + '</a></h4>' +
                        '<div class="caption-text"> </div>' +
                        '<div class="buttons">' +
                        '<a class="btn btn-theme" href="' +
                        item.url_point + '">' +item.moreinfo +'</a>' +
                        '</div>' +
                        '<table class="table">' +
                        '<tr>' +
                        iconst_ob +
                        '</tr>' +
                        '</table>' +
                        '</div>' +
                        '</div>' +
                        '<div style="border-top-width: 24px; position: absolute; ; margin-top: 0px; z-index: 0; left: 129px;"><div style="position: absolute; overflow: hidden; left: -6px; top: -1px; width: 16px; height: 30px;"><div style="position: absolute; left: 6px; transform: skewX(22.6deg); transform-origin: 0px 0px 0px; height: 24px; width: 10px; box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 6px; z-index: 1; background-color: rgb(255, 255, 255);"></div></div><div style="position: absolute; overflow: hidden; top: -1px; left: 10px; width: 16px; height: 30px;"><div style="position: absolute; left: 0px; transform: skewX(-22.6deg); transform-origin: 10px 0px 0px; height: 24px; width: 10px; box-shadow: rgba(255, 255, 255, 0.0980392) 0px 1px 6px; z-index: 1; background-color: rgb(255, 255, 255);"></div></div></div>' +

                        '</div>' +

                        '';
                    var contentString = '' +
                        '' +
                        '<div class="iw-container">' +
                        '<div class="iw-content">' +
                        '' + mapIWcontent +
                        '</div>' +
                        '<div class="iw-bottom-gradient"></div>' +
                        '</div>' +
                        '' +
                        '';
                    infowindow.close();
                    infowindow = new google.maps.InfoWindow({
                        content: contentString,
                        title: item.name_point
                        , maxWidth: 350
                        , maxHeight: 500
                    });
                    infowindow.close();
                    infowindow.open(mapObject, this);
                    // getInfoBoxBigImage2(item).open(mapObject, this);
                    var lng1 = new google.maps.LatLng(item.location_latitude, item.location_longitude);
                    mapObject.setCenter(lng1);
                    google.maps.event.addListener(infowindow, 'domready', function () {

                        rent_it_drav_windows();

                    });

                   // rent_it_drav_windows();
                }));
            }
        });
    }
    //clastern options
    var mcOptions = {
        gridSize: 20,
        maxZoom: 20,
        styles: [{
            height: 53,
            url:rentit_obj.theme_url+"/img/m1.png",
            width: 53
        }, {
            height: 56,
            url: rentit_obj.theme_url+"/img/m2.png",
            width: 56
        }, {
            height: 66,
            url: rentit_obj.theme_url+"/img/m3.png",
            width: 66
        }, {
            height: 78,
            url: rentit_obj.theme_url+"/img/m4.png",
            width: 78
        }, {
            height: 90,
            url:rentit_obj.theme_url+"/img/m5.png",
            width: 90
        }
        ]

    };
    Clusterer = new MarkerClusterer(mapObject, [], mcOptions);

    for (var key in markers)
        markersData[key].forEach(function (item) {
            //add  markers to Clusterer
            Clusterer.addMarkers(markers[key], true);

        });

    if (rentit_obj.lat.length < 3) {
        mapObject.fitBounds(bounds);
        mapObject.panToBounds(bounds);
        setTimeout(function () {
            mapObject.setZoom(parseInt(rentit_obj.zum));
        }, 1000);

    }

}

//google.maps.event.addDomListener(window, 'load', initialize_new);
function hideAllMarkers() {
    for (var key in markers)
        markers[key].forEach(function (marker) {
            marker.setMap(null);
        });
};

function toggleMarkers(category) {
    /*$("a").removeClass('activmap');
     $(category).addClass('activmap');*/
    hideAllMarkers();
    closeInfoBox();
    if ('undefined' === typeof markers[category])
        return false;
    markers[category].forEach(function (marker) {
        marker.setMap(mapObject);
        marker.setAnimation(google.maps.Animation.DROP);

    });

    //delet  Clusterer
    Clusterer.clearMarkers();
    // Clusterer add new Markers
    Clusterer.addMarkers(markers[category], true);
    // Clusterer redraw
    Clusterer.redraw()
};

function closeInfoBox() {
    jQuery('div.infoBox').remove();
};

function getInfoBox(item) {
    return new InfoBox({
        content: '<div class="marker_info none" id="marker_info">' +
            '<div class="info" id="info">' +
            '<img src="' + item.map_image_url + '" class="logotype" alt=""/>' +
            '<h2>' + item.name_point + '<span></span></h2>' +
            '<span>' + item.description_point + '</span>' +
            '<a href="' + item.url_point + '" class="green_btn">' + item.moreinfo + '</a>' +
            '<span class="arrow"></span>' +
            '</div>' +
            '</div>'
    });
};

function getInfoBoxBigImage2(item) {
    return '<div class="iw-container">' +
        '<div class="iw-content">' +
        '<div class="map-info-window">' +
        '<div class="thumbnail no-border no-padding thumbnail-car-card">' +
        '<div class="media">' +
        '<a class="media-link" href="' + item.url_point + '">' +
        '<img src="' + item.map_image_url + '" alt=""/>' +
        '<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>' +
        '</a>' +
        '</div>' +
        '<div class="caption text-center">' +
        '<h4 class="caption-title"><a href="' + item.url_point + '">' + item.name_point + '</a></h4>' +
        '<div class="caption-text">' + item.description_point + '</div>' +
        '<div class="buttons">' +
        '<a class="btn btn-theme" href="' + item.url_point + '">Rent It</a>' +
        '</div>' +
        '<table class="table">' +
        '<tr>' +
        '<td><i class="fa fa-car"></i> 2013</td>' +
        '<td><i class="fa fa-dashboard"></i> Diesel</td>' +
        '<td><i class="fa fa-cog"></i> Auto</td>' +
        '</tr>' +
        '</table>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '' + '</div>' +
        '<div class="iw-bottom-gradient"></div>' +
        '</div>' +
        '' +
        '';
}
function getInfoBoxBigImage(item) {
    return new InfoBox({
        content: '<div class="iw-container">' +
            '<div class="iw-content">' +
            '<div class="map-info-window">' +
            '<div class="thumbnail no-border no-padding thumbnail-car-card">' +
            '<div class="media">' +
            '<a class="media-link" href="' + item.url_point + '">' +
            '<img src="' + item.map_image_url + '" alt=""/>' +
            '<span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>' +
            '</a>' +
            '</div>' +
            '<div class="caption text-center">' +
            '<h4 class="caption-title"><a href="' + item.url_point + '">' + item.name_point + '</a></h4>' +
            '<div class="caption-text">' + item.description_point + '</div>' +
            '<div class="buttons">' +
            '<a class="btn btn-theme" href="' + item.url_point + '">Rent It</a>' +
            '</div>' +
            '<table class="table">' +
            '<tr>' +
            '<td><i class="fa fa-car"></i> 2013</td>' +
            '<td><i class="fa fa-dashboard"></i> Diesel</td>' +
            '<td><i class="fa fa-cog"></i> Auto</td>' +
            '</tr>' +
            '</table>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '' + '</div>' +
            '<div class="iw-bottom-gradient"></div>' +
            '</div>' +
            '' +
            '',
        disableAutoPan: true,
        maxWidth: 0,
        pixelOffset: new google.maps.Size(40, -210),
        closeBoxMargin: '50px 200px',
        closeBoxURL: '',
        isHidden: false,
        pane: 'floatPane',
        enableEventPropagation: true
    });

};

function find_me() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            mapObject.setCenter(pos);
        });
    }

}


function rent_it_drav_windows() {
    // Reference to the DIV which receives the contents of the infowindow using jQuery
    var iwOuter = jQuery('.gm-style-iw');

    /* The DIV we want to change is above the .gm-style-iw DIV.
     * So, we use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
     */
    var iwBackground = iwOuter.prev();
    iwOuter.prev().wrapAll("<div class='newmmmmmmmm'></div>");
    iwBackground.prev().addClass(".dddddd");
    // Remove the background shadow DIV
    iwBackground.children(':nth-child(2)').css({'display': 'none'});

    // Remove the white background DIV
    iwBackground.children(':nth-child(4)').css({'display': 'none'});

    // Moves the infowindow 115px to the right.
    iwOuter.parent().parent().css({left: '26px'});

    // Moves the shadow arrow // hide
    iwBackground.children(':nth-child(1)').attr('style', function (i, s) {
        return s + 'display: none !important;'
    });

    // Moves the arrow 76px to the left margin
    iwBackground.children(':nth-child(3)').attr('style', function (i, s) {
        return s + 'left: 128px !important; margin-top: -10px; z-index: 0;'
    });

    // Changes the desired color for the tail outline.
    // The outline of the tail is composed of two descendants of div which contains the tail.
    // The .find('div').children() method refers to all the div which are direct descendants of the previous div.
    iwBackground.children(':nth-child(3)').find('div').children().css({
        'box-shadow': 'rgba(255, 255, 255, 0.1) 0px 1px 6px',
        'z-index': '1',
        "display": 'none'

    });

    // Taking advantage of the already established reference to
    // div .gm-style-iw with iwOuter variable.
    // You must set a new variable iwCloseBtn.
    // Using the .next() method of JQuery you reference the following div to .gm-style-iw.
    // Is this div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();

    // Apply the desired effect to the close button
    iwCloseBtn.css({
        opacity: '1',
        right: '48px', top: '14px',
        width: '19px', height: '19px',
        border: '3px solid #ffffff',
        'border-radius': '17px',
        'background-color': '#ffffff'
    });

    // The API automatically applies 0.7 opacity to the button after the mouseout event.
    // This function reverses this event to the desired value.
    iwCloseBtn.mouseout(function () {
        jQuery(this).css({opacity: '1'});
    });
}


jQuery(window).load(function () {

    setTimeout(function () {
        if( typeof markers != 'undefined' && typeof markers['all'][0]  != 'undefined'){
            //set marker to map
            markers['all'][0].setMap(mapObject);
            google.maps.event.trigger(markers['all'][0], 'click');
        }

    }, 1000);
    /* if (typeof markers != 'undefined') {
         setTimeout(function () {
             if(typeof markers[rentit_obj.last_cat][0]  != 'undefined'){
                 //set marker to map
                 markers[rentit_obj.last_cat][0].setMap(mapObject);
                 google.maps.event.trigger(markers[rentit_obj.last_cat][0], 'click');
             }

         }, 500);

     }*/

});

function in_array(needle, haystack, strict) {	// Checks if a value exists in an array
    //
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)

    var found = false, key, strict = !!strict;

    for (key in haystack) {
        if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
            found = true;
            break;
        }
    }

    return found;
}

if(typeof  initialize_map == 'undefined'){
    function  initialize_map(){
        //   initialize_new();
    }
}

