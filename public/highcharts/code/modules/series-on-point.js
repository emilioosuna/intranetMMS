/**
 * Highcharts JS v11.3.0 (2024-01-10)
 *
 * Series on point module
 *
 * (c) 2010-2024 Highsoft AS
 * Author: Rafal Sebestjanski and Piotr Madej
 *
 * License: www.highcharts.com/license
 */!function(t){"object"==typeof module&&module.exports?(t.default=t,module.exports=t):"function"==typeof define&&define.amd?define("highcharts/modules/series-on-point",["highcharts"],function(e){return t(e),t.Highcharts=e,t}):t("undefined"!=typeof Highcharts?Highcharts:void 0)}(function(t){"use strict";var e=t?t._modules:{};function i(t,e,i,o){t.hasOwnProperty(e)||(t[e]=o.apply(null,i),"function"==typeof CustomEvent&&window.dispatchEvent(new CustomEvent("HighchartsModuleLoaded",{detail:{path:e,module:t[e]}})))}i(e,"Series/SeriesOnPointComposition.js",[e["Core/Globals.js"],e["Core/Series/Point.js"],e["Core/Series/Series.js"],e["Core/Series/SeriesRegistry.js"],e["Core/Renderer/SVG/SVGRenderer.js"],e["Core/Utilities.js"]],function(t,e,i,o,s,r){var n;let{composed:h}=t,{bubble:a,pie:d,sunburst:p}=o.seriesTypes,{addEvent:l,defined:c,find:f,isNumber:u,pushUnique:y}=r;return function(t){t.compose=function t(e,o){if(y(h,t)){let{chartGetZData:t,seriesAfterInit:s,seriesAfterRender:r,seriesGetCenter:n,seriesShowOrHide:h,seriesTranslate:a}=i.prototype;e.types.pie.prototype.onPointSupported=!0,l(e,"afterInit",s),l(e,"afterRender",r),l(e,"afterGetCenter",n),l(e,"hide",h),l(e,"show",h),l(e,"translate",a),l(o,"beforeRender",t),l(o,"beforeRedraw",t)}return e};class i{constructor(t){this.getRadii=a.prototype.getRadii,this.getRadius=a.prototype.getRadius,this.getPxExtremes=a.prototype.getPxExtremes,this.getZExtremes=a.prototype.getZExtremes,this.chart=t.chart,this.series=t,this.options=t.options.onPoint}drawConnector(){this.connector||(this.connector=this.series.chart.renderer.path().addClass("highcharts-connector-seriesonpoint").attr({zIndex:-1}).add(this.series.markerGroup));let t=this.getConnectorAttributes();t&&this.connector.animate(t)}getConnectorAttributes(){let t=this.series.chart,i=this.options;if(!i)return;let o=i.connectorOptions||{},r=i.position,n=t.get(i.id);if(!(n instanceof e)||!r||!c(n.plotX)||!c(n.plotY))return;let h=c(r.x)?r.x:n.plotX,a=c(r.y)?r.y:n.plotY,d=h+(r.offsetX||0),p=a+(r.offsetY||0),l=o.width||1,f=o.stroke||this.series.color,u=o.dashstyle,y={d:s.prototype.crispLine([["M",h,a],["L",d,p]],l,"ceil"),"stroke-width":l};return t.styledMode||(y.stroke=f,y.dashstyle=u),y}seriesAfterInit(){this.onPointSupported&&this.options.onPoint&&(this.bubblePadding=!0,this.useMapGeometry=!0,this.onPoint=new i(this))}seriesAfterRender(){delete this.chart.bubbleZExtremes,this.onPoint&&this.onPoint.drawConnector()}seriesGetCenter(t){let i=this.options.onPoint,o=t.positions;if(i){let t=this.chart.get(i.id);t instanceof e&&c(t.plotX)&&c(t.plotY)&&(o[0]=t.plotX,o[1]=t.plotY);let s=i.position;s&&(c(s.x)&&(o[0]=s.x),c(s.y)&&(o[1]=s.y),s.offsetX&&(o[0]+=s.offsetX),s.offsetY&&(o[1]+=s.offsetY))}let s=this.radii&&this.radii[this.index];u(s)&&(o[2]=2*s),t.positions=o}seriesShowOrHide(){let t=this.chart.series;this.points.forEach(e=>{let i=f(t,t=>{let i=((t.onPoint||{}).options||{}).id;return!!i&&i===e.id});i&&i.setVisible(!i.visible,!1)})}seriesTranslate(){this.onPoint&&(this.onPoint.getRadii(),this.radii=this.onPoint.radii)}chartGetZData(){let t=[];this.series.forEach(e=>{let i=e.options.onPoint;t.push(i&&i.z?i.z:null)}),this.series.forEach(e=>{e.onPoint&&(e.onPoint.zData=e.zData=t)})}}t.Additions=i}(n||(n={})),n}),i(e,"masters/modules/series-on-point.src.js",[e["Core/Globals.js"],e["Series/SeriesOnPointComposition.js"]],function(t,e){e.compose(t.Series,t.Chart)})});