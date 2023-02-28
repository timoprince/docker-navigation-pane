import{d as a,P as e,K as t,u as n,L as r,j as l,M as o,N as s,O as c,Q as i,S as u,U as v,V as f,h as p,_ as g,c as d,W as m,X as y,Y as x,Z as h,a as S,$ as b,a0 as z}from"./index.a08857e4.js";var A=a({name:"AAvatar",inheritAttrs:!1,props:{prefixCls:String,shape:{type:String,default:"circle"},size:{type:[Number,String,Object],default:function(){return"default"}},src:String,srcset:String,icon:e.any,alt:String,gap:Number,draggable:{type:Boolean,default:void 0},crossOrigin:String,loadError:{type:Function}},slots:["icon"],setup:function(a,e){var h=e.slots,S=e.attrs,b=t(!0),z=t(!1),A=t(1),C=t(null),P=t(null),j=n("avatar",a).prefixCls,N=r(),O=l((function(){return"default"===a.size?N.value:a.size})),k=o(),T=s((function(){if("object"===c(a.size)){var e=i.find((function(a){return k.value[a]}));return a.size[e]}})),W=function(){if(C.value&&P.value){var e=C.value.offsetWidth,t=P.value.offsetWidth;if(0!==e&&0!==t){var n=a.gap,r=void 0===n?4:n;2*r<t&&(A.value=t-2*r<e?(t-2*r)/e:1)}}},E=function(){var e=a.loadError;!1!==(null==e?void 0:e())&&(b.value=!1)};return u((function(){return a.src}),(function(){v((function(){b.value=!0,A.value=1}))})),u((function(){return a.gap}),(function(){v((function(){W()}))})),f((function(){v((function(){W(),z.value=!0}))})),function(){var e,t,n,r,l=a.shape,o=a.src,s=a.alt,c=a.srcset,i=a.draggable,u=a.crossOrigin,v=p(h,a,"icon"),f=j.value,N=(g(e={},"".concat(S.class),!!S.class),g(e,f,!0),g(e,"".concat(f,"-lg"),"large"===O.value),g(e,"".concat(f,"-sm"),"small"===O.value),g(e,"".concat(f,"-").concat(l),l),g(e,"".concat(f,"-image"),o&&b.value),g(e,"".concat(f,"-icon"),v),e),k="number"==typeof O.value?{width:"".concat(O.value,"px"),height:"".concat(O.value,"px"),lineHeight:"".concat(O.value,"px"),fontSize:v?"".concat(O.value/2,"px"):"18px"}:{},H=null===(t=h.default)||void 0===t?void 0:t.call(h);if(o&&b.value)n=d("img",{draggable:i,src:o,srcset:c,onError:E,alt:s,crossorigin:u},null);else if(v)n=v;else if(z.value||1!==A.value){var w="scale(".concat(A.value,") translateX(-50%)"),G={msTransform:w,WebkitTransform:w,transform:w},X="number"==typeof O.value?{lineHeight:"".concat(O.value,"px")}:{};n=d(y,{onResize:W},{default:function(){return[d("span",{class:"".concat(f,"-string"),ref:C,style:m(m({},X),G)},[H])]}})}else n=d("span",{class:"".concat(f,"-string"),ref:C,style:{opacity:0}},[H]);return d("span",x(x({},S),{},{ref:P,class:N,style:[k,(r=!!v,T.value?{width:"".concat(T.value,"px"),height:"".concat(T.value,"px"),lineHeight:"".concat(T.value,"px"),fontSize:"".concat(r?T.value/2:18,"px")}:{}),S.style]}),[n])}}}),C=a({name:"AAvatarGroup",inheritAttrs:!1,props:{prefixCls:String,maxCount:Number,maxStyle:{type:Object,default:void 0},maxPopoverPlacement:{type:String,default:"top"},maxPopoverTrigger:String,size:{type:[Number,String,Object],default:"default"}},setup:function(a,e){var t=e.slots,r=e.attrs,l=n("avatar-group",a),o=l.prefixCls,s=l.direction;return h(a),function(){var e,n=a.maxPopoverPlacement,l=void 0===n?"top":n,c=a.maxCount,i=a.maxStyle,u=a.maxPopoverTrigger,v=void 0===u?"hover":u,f=(g(e={},o.value,!0),g(e,"".concat(o.value,"-rtl"),"rtl"===s.value),g(e,"".concat(r.class),!!r.class),e),m=p(t,a),y=S(m).map((function(a,e){return b(a,{key:"avatar-key-".concat(e)})})),h=y.length;if(c&&c<h){var C=y.slice(0,c),P=y.slice(c,h);return C.push(d(z,{key:"avatar-popover-key",content:P,trigger:v,placement:l,overlayClassName:"".concat(o.value,"-popover")},{default:function(){return[d(A,{style:i},{default:function(){return["+".concat(h-c)]}})]}})),d("div",x(x({},r),{},{class:f,style:r.style}),[C])}return d("div",x(x({},r),{},{class:f,style:r.style}),[y])}}});A.Group=C,A.install=function(a){return a.component(A.name,A),a.component(C.name,C),a};export{A};