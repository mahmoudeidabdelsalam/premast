(function (factory) {
   typeof define === 'function' && define.amd ? define(factory) :
   factory();
}((function () { 'use strict';

   /**
    * @license
    * Copyright 2019 Google LLC
    * SPDX-License-Identifier: BSD-3-Clause
    */
   const t=window,e=t.ShadowRoot&&(void 0===t.ShadyCSS||t.ShadyCSS.nativeShadow)&&"adoptedStyleSheets"in Document.prototype&&"replace"in CSSStyleSheet.prototype,s=Symbol(),n=new WeakMap;class o{constructor(t,e,n){if(this._$cssResult$=!0,n!==s)throw Error("CSSResult is not constructable. Use `unsafeCSS` or `css` instead.");this.cssText=t,this.t=e;}get styleSheet(){let t=this.o;const s=this.t;if(e&&void 0===t){const e=void 0!==s&&1===s.length;e&&(t=n.get(s)),void 0===t&&((this.o=t=new CSSStyleSheet).replaceSync(this.cssText),e&&n.set(s,t));}return t}toString(){return this.cssText}}const r=t=>new o("string"==typeof t?t:t+"",void 0,s),i=(t,...e)=>{const n=1===t.length?t[0]:e.reduce(((e,s,n)=>e+(t=>{if(!0===t._$cssResult$)return t.cssText;if("number"==typeof t)return t;throw Error("Value passed to 'css' function must be a 'css' function result: "+t+". Use 'unsafeCSS' to pass non-literal values, but take care to ensure page security.")})(s)+t[n+1]),t[0]);return new o(n,t,s)},S=(s,n)=>{e?s.adoptedStyleSheets=n.map((t=>t instanceof CSSStyleSheet?t:t.styleSheet)):n.forEach((e=>{const n=document.createElement("style"),o=t.litNonce;void 0!==o&&n.setAttribute("nonce",o),n.textContent=e.cssText,s.appendChild(n);}));},c=e?t=>t:t=>t instanceof CSSStyleSheet?(t=>{let e="";for(const s of t.cssRules)e+=s.cssText;return r(e)})(t):t;//# sourceMappingURL=css-tag.js.map

   /**
    * @license
    * Copyright 2017 Google LLC
    * SPDX-License-Identifier: BSD-3-Clause
    */var s$1;const e$1=window,r$1=e$1.trustedTypes,h=r$1?r$1.emptyScript:"",o$1=e$1.reactiveElementPolyfillSupport,n$1={toAttribute(t,i){switch(i){case Boolean:t=t?h:null;break;case Object:case Array:t=null==t?t:JSON.stringify(t);}return t},fromAttribute(t,i){let s=t;switch(i){case Boolean:s=null!==t;break;case Number:s=null===t?null:Number(t);break;case Object:case Array:try{s=JSON.parse(t);}catch(t){s=null;}}return s}},a=(t,i)=>i!==t&&(i==i||t==t),l={attribute:!0,type:String,converter:n$1,reflect:!1,hasChanged:a};class d extends HTMLElement{constructor(){super(),this._$Ei=new Map,this.isUpdatePending=!1,this.hasUpdated=!1,this._$El=null,this.u();}static addInitializer(t){var i;this.finalize(),(null!==(i=this.h)&&void 0!==i?i:this.h=[]).push(t);}static get observedAttributes(){this.finalize();const t=[];return this.elementProperties.forEach(((i,s)=>{const e=this._$Ep(s,i);void 0!==e&&(this._$Ev.set(e,s),t.push(e));})),t}static createProperty(t,i=l){if(i.state&&(i.attribute=!1),this.finalize(),this.elementProperties.set(t,i),!i.noAccessor&&!this.prototype.hasOwnProperty(t)){const s="symbol"==typeof t?Symbol():"__"+t,e=this.getPropertyDescriptor(t,s,i);void 0!==e&&Object.defineProperty(this.prototype,t,e);}}static getPropertyDescriptor(t,i,s){return {get(){return this[i]},set(e){const r=this[t];this[i]=e,this.requestUpdate(t,r,s);},configurable:!0,enumerable:!0}}static getPropertyOptions(t){return this.elementProperties.get(t)||l}static finalize(){if(this.hasOwnProperty("finalized"))return !1;this.finalized=!0;const t=Object.getPrototypeOf(this);if(t.finalize(),void 0!==t.h&&(this.h=[...t.h]),this.elementProperties=new Map(t.elementProperties),this._$Ev=new Map,this.hasOwnProperty("properties")){const t=this.properties,i=[...Object.getOwnPropertyNames(t),...Object.getOwnPropertySymbols(t)];for(const s of i)this.createProperty(s,t[s]);}return this.elementStyles=this.finalizeStyles(this.styles),!0}static finalizeStyles(i){const s=[];if(Array.isArray(i)){const e=new Set(i.flat(1/0).reverse());for(const i of e)s.unshift(c(i));}else void 0!==i&&s.push(c(i));return s}static _$Ep(t,i){const s=i.attribute;return !1===s?void 0:"string"==typeof s?s:"string"==typeof t?t.toLowerCase():void 0}u(){var t;this._$E_=new Promise((t=>this.enableUpdating=t)),this._$AL=new Map,this._$Eg(),this.requestUpdate(),null===(t=this.constructor.h)||void 0===t||t.forEach((t=>t(this)));}addController(t){var i,s;(null!==(i=this._$ES)&&void 0!==i?i:this._$ES=[]).push(t),void 0!==this.renderRoot&&this.isConnected&&(null===(s=t.hostConnected)||void 0===s||s.call(t));}removeController(t){var i;null===(i=this._$ES)||void 0===i||i.splice(this._$ES.indexOf(t)>>>0,1);}_$Eg(){this.constructor.elementProperties.forEach(((t,i)=>{this.hasOwnProperty(i)&&(this._$Ei.set(i,this[i]),delete this[i]);}));}createRenderRoot(){var t;const s=null!==(t=this.shadowRoot)&&void 0!==t?t:this.attachShadow(this.constructor.shadowRootOptions);return S(s,this.constructor.elementStyles),s}connectedCallback(){var t;void 0===this.renderRoot&&(this.renderRoot=this.createRenderRoot()),this.enableUpdating(!0),null===(t=this._$ES)||void 0===t||t.forEach((t=>{var i;return null===(i=t.hostConnected)||void 0===i?void 0:i.call(t)}));}enableUpdating(t){}disconnectedCallback(){var t;null===(t=this._$ES)||void 0===t||t.forEach((t=>{var i;return null===(i=t.hostDisconnected)||void 0===i?void 0:i.call(t)}));}attributeChangedCallback(t,i,s){this._$AK(t,s);}_$EO(t,i,s=l){var e;const r=this.constructor._$Ep(t,s);if(void 0!==r&&!0===s.reflect){const h=(void 0!==(null===(e=s.converter)||void 0===e?void 0:e.toAttribute)?s.converter:n$1).toAttribute(i,s.type);this._$El=t,null==h?this.removeAttribute(r):this.setAttribute(r,h),this._$El=null;}}_$AK(t,i){var s;const e=this.constructor,r=e._$Ev.get(t);if(void 0!==r&&this._$El!==r){const t=e.getPropertyOptions(r),h="function"==typeof t.converter?{fromAttribute:t.converter}:void 0!==(null===(s=t.converter)||void 0===s?void 0:s.fromAttribute)?t.converter:n$1;this._$El=r,this[r]=h.fromAttribute(i,t.type),this._$El=null;}}requestUpdate(t,i,s){let e=!0;void 0!==t&&(((s=s||this.constructor.getPropertyOptions(t)).hasChanged||a)(this[t],i)?(this._$AL.has(t)||this._$AL.set(t,i),!0===s.reflect&&this._$El!==t&&(void 0===this._$EC&&(this._$EC=new Map),this._$EC.set(t,s))):e=!1),!this.isUpdatePending&&e&&(this._$E_=this._$Ej());}async _$Ej(){this.isUpdatePending=!0;try{await this._$E_;}catch(t){Promise.reject(t);}const t=this.scheduleUpdate();return null!=t&&await t,!this.isUpdatePending}scheduleUpdate(){return this.performUpdate()}performUpdate(){var t;if(!this.isUpdatePending)return;this.hasUpdated,this._$Ei&&(this._$Ei.forEach(((t,i)=>this[i]=t)),this._$Ei=void 0);let i=!1;const s=this._$AL;try{i=this.shouldUpdate(s),i?(this.willUpdate(s),null===(t=this._$ES)||void 0===t||t.forEach((t=>{var i;return null===(i=t.hostUpdate)||void 0===i?void 0:i.call(t)})),this.update(s)):this._$Ek();}catch(t){throw i=!1,this._$Ek(),t}i&&this._$AE(s);}willUpdate(t){}_$AE(t){var i;null===(i=this._$ES)||void 0===i||i.forEach((t=>{var i;return null===(i=t.hostUpdated)||void 0===i?void 0:i.call(t)})),this.hasUpdated||(this.hasUpdated=!0,this.firstUpdated(t)),this.updated(t);}_$Ek(){this._$AL=new Map,this.isUpdatePending=!1;}get updateComplete(){return this.getUpdateComplete()}getUpdateComplete(){return this._$E_}shouldUpdate(t){return !0}update(t){void 0!==this._$EC&&(this._$EC.forEach(((t,i)=>this._$EO(i,this[i],t))),this._$EC=void 0),this._$Ek();}updated(t){}firstUpdated(t){}}d.finalized=!0,d.elementProperties=new Map,d.elementStyles=[],d.shadowRootOptions={mode:"open"},null==o$1||o$1({ReactiveElement:d}),(null!==(s$1=e$1.reactiveElementVersions)&&void 0!==s$1?s$1:e$1.reactiveElementVersions=[]).push("1.6.1");//# sourceMappingURL=reactive-element.js.map

   /**
    * @license
    * Copyright 2017 Google LLC
    * SPDX-License-Identifier: BSD-3-Clause
    */
   var t$1;const i$1=window,s$2=i$1.trustedTypes,e$2=s$2?s$2.createPolicy("lit-html",{createHTML:t=>t}):void 0,o$2=`lit$${(Math.random()+"").slice(9)}$`,n$2="?"+o$2,l$1=`<${n$2}>`,h$1=document,r$2=(t="")=>h$1.createComment(t),d$1=t=>null===t||"object"!=typeof t&&"function"!=typeof t,u=Array.isArray,c$1=t=>u(t)||"function"==typeof(null==t?void 0:t[Symbol.iterator]),v=/<(?:(!--|\/[^a-zA-Z])|(\/?[a-zA-Z][^>\s]*)|(\/?$))/g,a$1=/-->/g,f=/>/g,_=RegExp(">|[ \t\n\f\r](?:([^\\s\"'>=/]+)([ \t\n\f\r]*=[ \t\n\f\r]*(?:[^ \t\n\f\r\"'`<>=]|(\"|')|))|$)","g"),m=/'/g,p=/"/g,$=/^(?:script|style|textarea|title)$/i,g=t=>(i,...s)=>({_$litType$:t,strings:i,values:s}),y=g(1),x=Symbol.for("lit-noChange"),b=Symbol.for("lit-nothing"),T=new WeakMap,A=h$1.createTreeWalker(h$1,129,null,!1),E=(t,i)=>{const s=t.length-1,n=[];let h,r=2===i?"<svg>":"",d=v;for(let i=0;i<s;i++){const s=t[i];let e,u,c=-1,g=0;for(;g<s.length&&(d.lastIndex=g,u=d.exec(s),null!==u);)g=d.lastIndex,d===v?"!--"===u[1]?d=a$1:void 0!==u[1]?d=f:void 0!==u[2]?($.test(u[2])&&(h=RegExp("</"+u[2],"g")),d=_):void 0!==u[3]&&(d=_):d===_?">"===u[0]?(d=null!=h?h:v,c=-1):void 0===u[1]?c=-2:(c=d.lastIndex-u[2].length,e=u[1],d=void 0===u[3]?_:'"'===u[3]?p:m):d===p||d===m?d=_:d===a$1||d===f?d=v:(d=_,h=void 0);const y=d===_&&t[i+1].startsWith("/>")?" ":"";r+=d===v?s+l$1:c>=0?(n.push(e),s.slice(0,c)+"$lit$"+s.slice(c)+o$2+y):s+o$2+(-2===c?(n.push(void 0),i):y);}const u=r+(t[s]||"<?>")+(2===i?"</svg>":"");if(!Array.isArray(t)||!t.hasOwnProperty("raw"))throw Error("invalid template strings array");return [void 0!==e$2?e$2.createHTML(u):u,n]};class C{constructor({strings:t,_$litType$:i},e){let l;this.parts=[];let h=0,d=0;const u=t.length-1,c=this.parts,[v,a]=E(t,i);if(this.el=C.createElement(v,e),A.currentNode=this.el.content,2===i){const t=this.el.content,i=t.firstChild;i.remove(),t.append(...i.childNodes);}for(;null!==(l=A.nextNode())&&c.length<u;){if(1===l.nodeType){if(l.hasAttributes()){const t=[];for(const i of l.getAttributeNames())if(i.endsWith("$lit$")||i.startsWith(o$2)){const s=a[d++];if(t.push(i),void 0!==s){const t=l.getAttribute(s.toLowerCase()+"$lit$").split(o$2),i=/([.?@])?(.*)/.exec(s);c.push({type:1,index:h,name:i[2],strings:t,ctor:"."===i[1]?M:"?"===i[1]?k:"@"===i[1]?H:S$1});}else c.push({type:6,index:h});}for(const i of t)l.removeAttribute(i);}if($.test(l.tagName)){const t=l.textContent.split(o$2),i=t.length-1;if(i>0){l.textContent=s$2?s$2.emptyScript:"";for(let s=0;s<i;s++)l.append(t[s],r$2()),A.nextNode(),c.push({type:2,index:++h});l.append(t[i],r$2());}}}else if(8===l.nodeType)if(l.data===n$2)c.push({type:2,index:h});else {let t=-1;for(;-1!==(t=l.data.indexOf(o$2,t+1));)c.push({type:7,index:h}),t+=o$2.length-1;}h++;}}static createElement(t,i){const s=h$1.createElement("template");return s.innerHTML=t,s}}function P(t,i,s=t,e){var o,n,l,h;if(i===x)return i;let r=void 0!==e?null===(o=s._$Co)||void 0===o?void 0:o[e]:s._$Cl;const u=d$1(i)?void 0:i._$litDirective$;return (null==r?void 0:r.constructor)!==u&&(null===(n=null==r?void 0:r._$AO)||void 0===n||n.call(r,!1),void 0===u?r=void 0:(r=new u(t),r._$AT(t,s,e)),void 0!==e?(null!==(l=(h=s)._$Co)&&void 0!==l?l:h._$Co=[])[e]=r:s._$Cl=r),void 0!==r&&(i=P(t,r._$AS(t,i.values),r,e)),i}class V{constructor(t,i){this.u=[],this._$AN=void 0,this._$AD=t,this._$AM=i;}get parentNode(){return this._$AM.parentNode}get _$AU(){return this._$AM._$AU}v(t){var i;const{el:{content:s},parts:e}=this._$AD,o=(null!==(i=null==t?void 0:t.creationScope)&&void 0!==i?i:h$1).importNode(s,!0);A.currentNode=o;let n=A.nextNode(),l=0,r=0,d=e[0];for(;void 0!==d;){if(l===d.index){let i;2===d.type?i=new N(n,n.nextSibling,this,t):1===d.type?i=new d.ctor(n,d.name,d.strings,this,t):6===d.type&&(i=new I(n,this,t)),this.u.push(i),d=e[++r];}l!==(null==d?void 0:d.index)&&(n=A.nextNode(),l++);}return o}p(t){let i=0;for(const s of this.u)void 0!==s&&(void 0!==s.strings?(s._$AI(t,s,i),i+=s.strings.length-2):s._$AI(t[i])),i++;}}class N{constructor(t,i,s,e){var o;this.type=2,this._$AH=b,this._$AN=void 0,this._$AA=t,this._$AB=i,this._$AM=s,this.options=e,this._$Cm=null===(o=null==e?void 0:e.isConnected)||void 0===o||o;}get _$AU(){var t,i;return null!==(i=null===(t=this._$AM)||void 0===t?void 0:t._$AU)&&void 0!==i?i:this._$Cm}get parentNode(){let t=this._$AA.parentNode;const i=this._$AM;return void 0!==i&&11===t.nodeType&&(t=i.parentNode),t}get startNode(){return this._$AA}get endNode(){return this._$AB}_$AI(t,i=this){t=P(this,t,i),d$1(t)?t===b||null==t||""===t?(this._$AH!==b&&this._$AR(),this._$AH=b):t!==this._$AH&&t!==x&&this.g(t):void 0!==t._$litType$?this.$(t):void 0!==t.nodeType?this.T(t):c$1(t)?this.k(t):this.g(t);}O(t,i=this._$AB){return this._$AA.parentNode.insertBefore(t,i)}T(t){this._$AH!==t&&(this._$AR(),this._$AH=this.O(t));}g(t){this._$AH!==b&&d$1(this._$AH)?this._$AA.nextSibling.data=t:this.T(h$1.createTextNode(t)),this._$AH=t;}$(t){var i;const{values:s,_$litType$:e}=t,o="number"==typeof e?this._$AC(t):(void 0===e.el&&(e.el=C.createElement(e.h,this.options)),e);if((null===(i=this._$AH)||void 0===i?void 0:i._$AD)===o)this._$AH.p(s);else {const t=new V(o,this),i=t.v(this.options);t.p(s),this.T(i),this._$AH=t;}}_$AC(t){let i=T.get(t.strings);return void 0===i&&T.set(t.strings,i=new C(t)),i}k(t){u(this._$AH)||(this._$AH=[],this._$AR());const i=this._$AH;let s,e=0;for(const o of t)e===i.length?i.push(s=new N(this.O(r$2()),this.O(r$2()),this,this.options)):s=i[e],s._$AI(o),e++;e<i.length&&(this._$AR(s&&s._$AB.nextSibling,e),i.length=e);}_$AR(t=this._$AA.nextSibling,i){var s;for(null===(s=this._$AP)||void 0===s||s.call(this,!1,!0,i);t&&t!==this._$AB;){const i=t.nextSibling;t.remove(),t=i;}}setConnected(t){var i;void 0===this._$AM&&(this._$Cm=t,null===(i=this._$AP)||void 0===i||i.call(this,t));}}class S$1{constructor(t,i,s,e,o){this.type=1,this._$AH=b,this._$AN=void 0,this.element=t,this.name=i,this._$AM=e,this.options=o,s.length>2||""!==s[0]||""!==s[1]?(this._$AH=Array(s.length-1).fill(new String),this.strings=s):this._$AH=b;}get tagName(){return this.element.tagName}get _$AU(){return this._$AM._$AU}_$AI(t,i=this,s,e){const o=this.strings;let n=!1;if(void 0===o)t=P(this,t,i,0),n=!d$1(t)||t!==this._$AH&&t!==x,n&&(this._$AH=t);else {const e=t;let l,h;for(t=o[0],l=0;l<o.length-1;l++)h=P(this,e[s+l],i,l),h===x&&(h=this._$AH[l]),n||(n=!d$1(h)||h!==this._$AH[l]),h===b?t=b:t!==b&&(t+=(null!=h?h:"")+o[l+1]),this._$AH[l]=h;}n&&!e&&this.j(t);}j(t){t===b?this.element.removeAttribute(this.name):this.element.setAttribute(this.name,null!=t?t:"");}}class M extends S$1{constructor(){super(...arguments),this.type=3;}j(t){this.element[this.name]=t===b?void 0:t;}}const R=s$2?s$2.emptyScript:"";class k extends S$1{constructor(){super(...arguments),this.type=4;}j(t){t&&t!==b?this.element.setAttribute(this.name,R):this.element.removeAttribute(this.name);}}class H extends S$1{constructor(t,i,s,e,o){super(t,i,s,e,o),this.type=5;}_$AI(t,i=this){var s;if((t=null!==(s=P(this,t,i,0))&&void 0!==s?s:b)===x)return;const e=this._$AH,o=t===b&&e!==b||t.capture!==e.capture||t.once!==e.once||t.passive!==e.passive,n=t!==b&&(e===b||o);o&&this.element.removeEventListener(this.name,this,e),n&&this.element.addEventListener(this.name,this,t),this._$AH=t;}handleEvent(t){var i,s;"function"==typeof this._$AH?this._$AH.call(null!==(s=null===(i=this.options)||void 0===i?void 0:i.host)&&void 0!==s?s:this.element,t):this._$AH.handleEvent(t);}}class I{constructor(t,i,s){this.element=t,this.type=6,this._$AN=void 0,this._$AM=i,this.options=s;}get _$AU(){return this._$AM._$AU}_$AI(t){P(this,t);}}const z=i$1.litHtmlPolyfillSupport;null==z||z(C,N),(null!==(t$1=i$1.litHtmlVersions)&&void 0!==t$1?t$1:i$1.litHtmlVersions=[]).push("2.6.1");const Z=(t,i,s)=>{var e,o;const n=null!==(e=null==s?void 0:s.renderBefore)&&void 0!==e?e:i;let l=n._$litPart$;if(void 0===l){const t=null!==(o=null==s?void 0:s.renderBefore)&&void 0!==o?o:null;n._$litPart$=l=new N(i.insertBefore(r$2(),t),t,void 0,null!=s?s:{});}return l._$AI(t),l};//# sourceMappingURL=lit-html.js.map

   /**
    * @license
    * Copyright 2017 Google LLC
    * SPDX-License-Identifier: BSD-3-Clause
    */var l$2,o$3;class s$3 extends d{constructor(){super(...arguments),this.renderOptions={host:this},this._$Do=void 0;}createRenderRoot(){var t,e;const i=super.createRenderRoot();return null!==(t=(e=this.renderOptions).renderBefore)&&void 0!==t||(e.renderBefore=i.firstChild),i}update(t){const i=this.render();this.hasUpdated||(this.renderOptions.isConnected=this.isConnected),super.update(t),this._$Do=Z(i,this.renderRoot,this.renderOptions);}connectedCallback(){var t;super.connectedCallback(),null===(t=this._$Do)||void 0===t||t.setConnected(!0);}disconnectedCallback(){var t;super.disconnectedCallback(),null===(t=this._$Do)||void 0===t||t.setConnected(!1);}render(){return x}}s$3.finalized=!0,s$3._$litElement$=!0,null===(l$2=globalThis.litElementHydrateSupport)||void 0===l$2||l$2.call(globalThis,{LitElement:s$3});const n$3=globalThis.litElementPolyfillSupport;null==n$3||n$3({LitElement:s$3});(null!==(o$3=globalThis.litElementVersions)&&void 0!==o$3?o$3:globalThis.litElementVersions=[]).push("3.2.2");//# sourceMappingURL=lit-element.js.map

   class Col extends s$3 {
      static get styles() {
         return [
            i`
            :host {
               display: flex;
               flex-direction: column;
               gap: 1rem;
            }
         `,
         ];
      }

      render() {
         return y` <slot></slot> `;
      }
   }

   if (!customElements.get("pmst-col")) {
      customElements.define("pmst-col", Col);
   }

   class Row extends s$3 {
      static get styles() {
         return [
            i`
            :host {
               display: flex;
               flex-direction: row;
               gap: 1rem;
            }
         `,
         ];
      }

      render() {
         return y` <slot></slot> `;
      }
   }

   if (!customElements.get("pmst-row")) {
      customElements.define("pmst-row", Row);
   }

   var colors = i`
   :host {
      --color-netural-50: #fbfaff;
      --color-netural-100: #eeedf5;
      --color-netural-200: #dbdae5;
      --color-netural-300: #c9c8d9;
      --color-netural-400: #bdbccc;
      --color-netural-500: #acaabd;
      --color-netural-600: #807d96;
      --color-netural-700: #1e1b35;
      --color-netural-800: #171235;
      --color-netural-900: #0d072d;

      --color-primary-50: #bcdffb;
      --color-primary-100: #73befb;
      --color-primary-200: #3794f8;
      --color-primary-300: #1f75ee;
      --color-primary-400: #2250ac;

      --color-secondary-50: #b5f5ee;
      --color-secondary-100: #84f5e9;
      --color-secondary-200: #0cebd4;
      --color-secondary-300: #26d6c4;
      --color-secondary-400: #13bfae;

      --color-success-50: #daf2ea;
      --color-success-100: #298063;
      --color-warning-50: #ffe1e1;
      --color-warning-100: #f30101;
      --color-danger-50: #fff1f0;
      --color-danger-100: #ffd6d5;
      --color-info-50: #e6f7ff;
      --color-info-100: #bae7ff;
   }
`;

   const theme = {
      colors: {
         primary: {
            main: i`#1E6DFB`,
            light: i`#BCD3FE`,
            dark: i`#1857C9`,
            contrastText: i`#ffffff`,
         },
      },

      typography: {},

      radius: {
         small: i`4px`,
         medium: i`8px`,
         large: i`16px`,
      },

      elevation: {
         0: i`none`,
         1: i`0 1px 3px 0 rgba(0, 0, 0, 0.16), 0 1px 1px 0 rgba(0, 0, 0, 0.10), 0 2px 1px -1px rgba(0, 0, 0, 0.10)`,
         2: i`0 1px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 2px 0 rgba(0, 0, 0, 0.10), 0 3px 1px -2px rgba(0, 0, 0, 0.10)`,
         3: i`0 1px 8px 0 rgba(0, 0, 0, 0.16), 0 3px 4px 0 rgba(0, 0, 0, 0.10), 0 3px 3px -2px rgba(0, 0, 0, 0.10)`,
         4: i`0 2px 4px -1px rgba(0, 0, 0, 0.16), 0 4px 5px 0 rgba(0, 0, 0, 0.10), 0 1px 10px 0 rgba(0, 0, 0, 0.10)`,
         5: i`0 3px 5px -1px rgba(0, 0, 0, 0.16), 0 5px 8px 0 rgba(0, 0, 0, 0.10), 0 1px 14px 0 rgba(0, 0, 0, 0.10)`,
      },
   };

   const styles = i`
   ${colors}
   :host {
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
   }

   :host([hidden]) {
      display: none;
   }

   :host([disabled]) {
      cursor: not-allowed;
   }

   button {
      background-color: ${theme.colors.primary.main};
      border: none;
      border-radius: ${theme.radius.medium};
      color: ${theme.colors.primary.contrastText};
      cursor: pointer;
      outline: none;
      transition: background-color 0.2s ease-in-out;
      width: 100%;
      padding: 0.6rem 1.2rem;
      font-size: 1rem;
   }

   :host([size="small"]) button {
      font-size: 0.8rem;
      padding: 0.6rem 1rem;
   }

   :host([size="large"]) button {
      font-size: 1.2rem;
      padding: 1rem 1.4rem;
   }

   button:hover {
      background-color: ${theme.colors.primary.dark};
   }

   button:active {
      background-color: ${theme.colors.primary.light};
   }

   button[disabled] {
      background-color: ${theme.colors.primary.light};
      cursor: not-allowed;
   }

   button[disabled]:hover {
      background-color: ${theme.colors.primary.light};
   }

   button[disabled]:active {
      background-color: ${theme.colors.primary.light};
   }
`;

   class Button extends s$3 {
      static get styles() {
         return [styles];
      }

      static get properties() {
         return {
            sx: { type: String },
         };
      }

      constructor() {
         super();
      }

      handleClick() {
         this.dispatchEvent(new CustomEvent("click"));
      }

      render() {
         return y`
         <button>
            <slot></slot>
         </button>
      `;
      }
   }

   customElements.define("pmst-button", Button);

   class pmstComponents extends s$3 {
      static get properties() {
         return {
            name: { type: String },
         };
      }

      constructor() {
         super();
         this.name = "World";
      }

      render() {
         return y` <h1>components</h1>

         <pmst-col
            >Buttons
            <pmst-row>
               <pmst-button size="small"> Small </pmst-button>
               <pmst-button> Normal </pmst-button>
               <pmst-button size="large"> Large </pmst-button>
            </pmst-row>
         </pmst-col>

         <pmst-col
            >Paper
            <pmst-row>
               <pmst-paper style="width: 100px; height: 100px" elevation="1">paper</pmst-paper>
               <pmst-paper style="width: 100px; height: 100px" elevation="2">paper</pmst-paper>
               <pmst-paper style="width: 100px; height: 100px" elevation="3">paper</pmst-paper>
               <pmst-paper style="width: 100px; height: 100px" elevation="4">paper</pmst-paper>
               <pmst-paper style="width: 100px; height: 100px" elevation="5">paper</pmst-paper>
            </pmst-row>
         </pmst-col>`;
      }
   }

   if (!customElements.get("pmst-component")) {
      customElements.define("pmst-component", pmstComponents);
   }

   const elevation = theme.elevation;
   const radius = theme.radius.small;

   const PaperStyle = i`
   :host {
      display: block;
      border-radius: ${radius};
   }

   :host([elevation="0"]) {
      box-shadow: none;
   }

   :host([elevation="1"]) {
      box-shadow: ${elevation[1]};
   }

   :host([elevation="2"]) {
      box-shadow: ${elevation[2]};
   }

   :host([elevation="3"]) {
      box-shadow: ${elevation[3]};
   }

   :host([elevation="4"]) {
      box-shadow: ${elevation[4]};
   }

   :host([elevation="5"]) {
      box-shadow: ${elevation[5]};
   }
`;

   class Paper extends s$3 {
      static get styles() {
         return [PaperStyle];
      }

      static get properties() {
         return {
            elevation: {
               type: Number,
            },
         };
      }
      constructor() {
         super();
         this.elevation = 0;
      }
      render() {
         return y`
         <div class="paper">
            <slot></slot>
         </div>
      `;
      }
   }

   if (!customElements.get("pmst-paper")) {
      customElements.define("pmst-paper", Paper);
   }

   var style = i`
   :host {
   }
   #header-top {
      font-weight: 400;
      font-family: "Roboto";
      display: block;
      background-color: #f9f9f9;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      min-height: 70px;
      border-bottom: 1px solid #e3e3e3;
      gap: 16px;
      z-index: 100;
      box-sizing: border-box;
   }
   #header-top-left {
      display: flex;
      flex-direction: row;
      align-items: center;
      height: max-content;
      min-width: 100px;
   }
   ul {
      display: flex;
      flex-direction: row;
      align-items: center;
      list-style: none;
      margin: 0;
      padding: 0;
   }
   li a {
      text-decoration: none;
      margin: 0 12px;
      color: var(--color-netural-700);
   }
   .nav-text a:hover {
      color: var(--color-primary-300);
   }
   #header-top-right {
      display: flex;
      flex-direction: row;
      align-items: right;
      gap: 16px;
      max-width: max-content;
      align-items: center;
      min-width: 100px;
   }
   #header-top-right a {
      text-decoration: none;
      color: #000;
      font-size: 16px;
   }
   #signin-buttons {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 4px;
   }

   #logo-link img {
      display: block;
      width: auto;
      height: 100%;
      max-height: 20px;
   }
   #more-wrapper {
      position: relative;
   }
   #more {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 2px;
      margin-left: 8px;
      position: relative;
   }
   #more::before {
      content: "";
      display: block;
      width: 1px;
      height: 16px;
      background-color: #e3e3e3;
      margin-right: 8px;
   }
   #more-icon {
      display: flex;
   }
   #more-icon svg {
      width: 14px;
   }
   #more:hover > div {
      color: var(--color-primary-300) !important;
   }
   #more:hover #more-icon svg {
      fill: var(--color-primary-300) !important;
   }
   pmst-more-dropdown {
      position: absolute;
      top: 140%;
      left: 10%;
      z-index: 999;
   }
   @media (max-width: 992px) {
      #header-top-left {
         gap: 8px;
      }
   }
   @media (max-width: 768px) {
      #header-top {
         padding: 0 16px;
         max-width: calc(100% - 32px);
      }
      #header-top-right {
         gap: 8px;
      }
   }
   @media (max-width: 480px) {
   }
   @media (max-width: 320px) {
   }
`;

   var buttons = i`
   ${colors}
   button {
      border-radius: 100px;
      cursor: pointer;
      min-width: max-content;
   }
   button:disabled {
      cursor: unset;
      opacity: 0.5;
   }
   .btn-primary-small {
      color: rgb(255, 255, 255);
      border: none;
      padding: 8px 20px;
      font-size: 12px;
      font-weight: 400;
      background-image: linear-gradient(45deg, var(--color-primary-300) 0%, var(--color-primary-400) 60%);
   }
   .btn-primary-normal {
      color: rgb(255, 255, 255);
      border: none;
      padding: 10px 24px;
      font-size: 14px;
      font-weight: 400;
      background-image: linear-gradient(45deg, var(--color-primary-300) 0%, var(--color-primary-400) 60%);
   }
   .btn-primary-large {
      color: rgb(255, 255, 255);
      border: none;
      border-radius: 50px;
      padding: 12px 20px;
      font-size: 16px;
      font-weight: 400;
      background-image: linear-gradient(45deg, var(--color-primary-300) 0%, var(--color-primary-400) 60%);
   }
   .btn-secondary-small {
   }
   .btn-secondary-normal {
   }
   .btn-secondary-large {
   }
   .btn-flat-small {
      background-color: transparent;
      color: var(--color-primary-400);
      border: none;
      border-radius: 50px;
      padding: 8px 20px;
      font-size: 12px;
      font-weight: 400;
   }
   .btn-flat-small:hover {
      background-color: var(--color-netural-100);
   }
   .btn-flat-normal {
      background-color: transparent;
      color: var(--color-primary-400);
      border: none;
      border-radius: 50px;
      padding: 8px 20px;
      font-size: 14px;
      font-weight: 400;
   }
   .btn-flat-normal:hover {
      background-color: var(--color-netural-100);
   }

   @media (max-width: 768px) {
      .btn-primary-normal {
         padding: 8px 16px;
         font-size: 12px;
      }
   }
   @media (max-width: 375px) {
   }
`;

   var typo = i`
   h1,
   h2,
   h3,
   h4,
   h5,
   h6,
   p,
   span {
      font-family: "Roboto", "sans-serif";
      margin: 0;
   }
   .nav-text {
      font-family: "Roboto";
      font-size: 14px;
      font-weight: 400;
      color: var(--color-netural-700);
      min-width: max-content;
   }
   h1 {
   }
   h2 {
      font-size: 30px;
      font-weight: 500;
      letter-spacing: 0.13px;
   }
   h3 {
      font-size: 24px;
      font-weight: 400;
   }
   h4 {
      font-size: 20px;
      font-weight: 400;
   }
   h5 {
      font-size: 16px;
      font-weight: 400;
      letter-spacing: 0.04px;
   }
   h6 {
      font-size: 14px;
      font-weight: 400;
   }
   p {
      font-size: 14px;
      font-weight: 400;
      letter-spacing: 0.04px;
   }
   p.small {
      font-size: 12px;
      font-weight: 400;
      letter-spacing: 0.04px;
   }

   @media (max-width: 768px) {
      h1 {
         font-size: 30px;
      }
      h4 {
         font-size: 18px;
      }
   }
   @media (min-width: 375px) {
   }
`;

   let pmst_icons = {
      arrow_down: y` <svg width="13" height="8" viewBox="0 0 13 8" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M6.03516 7.19531C6.28125 7.44141 6.69141 7.44141 6.9375 7.19531L12.2695 1.89062C12.5156 1.61719 12.5156 1.20703 12.2695 0.960938L11.6406 0.332031C11.3945 0.0859375 10.9844 0.0859375 10.7109 0.332031L6.5 4.54297L2.26172 0.332031C1.98828 0.0859375 1.57812 0.0859375 1.33203 0.332031L0.703125 0.960938C0.457031 1.20703 0.457031 1.61719 0.703125 1.89062L6.03516 7.19531Z"
         fill="#A6A6A6"
      />
   </svg>`,
      arrow_left: y`
      <svg width="7" height="12" viewBox="0 0 7 12" fill="#818181" xmlns="http://www.w3.org/2000/svg">
         <path
            d="M4.875 10.875L0.275 6.275C0.175 6.175 0.104333 6.06667 0.0629997 5.95C0.0209997 5.83333 0 5.70833 0 5.575C0 5.44167 0.0209997 5.31667 0.0629997 5.2C0.104333 5.08333 0.175 4.975 0.275 4.875L4.875 0.275C5.05833 0.0916663 5.29167 0 5.575 0C5.85833 0 6.09167 0.0916663 6.275 0.275C6.45833 0.458333 6.55 0.691667 6.55 0.975C6.55 1.25833 6.45833 1.49167 6.275 1.675L2.375 5.575L6.275 9.475C6.45833 9.65833 6.55 9.89167 6.55 10.175C6.55 10.4583 6.45833 10.6917 6.275 10.875C6.09167 11.0583 5.85833 11.15 5.575 11.15C5.29167 11.15 5.05833 11.0583 4.875 10.875Z"
         />
      </svg>
   `,
      arrow_right: y`
      <svg width="8" height="13" viewBox="0 0 8 13" fill="#D4D2D9" xmlns="http://www.w3.org/2000/svg">
         <path
            d="M0.787939 11.8719C0.604606 11.6886 0.512939 11.4553 0.512939 11.1719C0.512939 10.8886 0.604606 10.6553 0.787939 10.4719L4.68794 6.57195L0.787939 2.67195C0.604606 2.48862 0.512939 2.25528 0.512939 1.97195C0.512939 1.68861 0.604606 1.45528 0.787939 1.27195C0.971272 1.08861 1.20461 0.996948 1.48794 0.996948C1.77127 0.996948 2.00461 1.08861 2.18794 1.27195L6.78794 5.87195C6.88794 5.97195 6.95894 6.08028 7.00094 6.19695C7.04227 6.31361 7.06294 6.43861 7.06294 6.57195C7.06294 6.70528 7.04227 6.83028 7.00094 6.94695C6.95894 7.06361 6.88794 7.17195 6.78794 7.27195L2.18794 11.8719C2.00461 12.0553 1.77127 12.1469 1.48794 12.1469C1.20461 12.1469 0.971272 12.0553 0.787939 11.8719Z"
         />
      </svg>
   `,
      avatar_premium: y`<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
      <circle cx="8" cy="8" r="8" fill="#F08910" />
      <path
         d="M7.99948 2.1333L9.31663 6.18707H13.579L10.1307 8.69243L11.4478 12.7462L7.99948 10.2408L4.55114 12.7462L5.86829 8.69243L2.41995 6.18707H6.68233L7.99948 2.1333Z"
         fill="white"
      />
   </svg> `,

      more_icon: y`<svg width="20" height="21" viewBox="0 0 20 21" fill="#61616B" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M5.41667 9.66662L10 2.16663L14.5833 9.66662H5.41667ZM14.5833 18.8333C13.5417 18.8333 12.6561 18.4688 11.9267 17.74C11.1978 17.0105 10.8333 16.125 10.8333 15.0833C10.8333 14.0416 11.1978 13.1561 11.9267 12.4266C12.6561 11.6977 13.5417 11.3333 14.5833 11.3333C15.625 11.3333 16.5106 11.6977 17.24 12.4266C17.9689 13.1561 18.3333 14.0416 18.3333 15.0833C18.3333 16.125 17.9689 17.0105 17.24 17.74C16.5106 18.4688 15.625 18.8333 14.5833 18.8333ZM2.5 18.4166V11.75H9.16667V18.4166H2.5ZM14.5833 17.1666C15.1667 17.1666 15.6597 16.9652 16.0625 16.5625C16.4653 16.1597 16.6667 15.6666 16.6667 15.0833C16.6667 14.5 16.4653 14.0069 16.0625 13.6041C15.6597 13.2013 15.1667 13 14.5833 13C14 13 13.5069 13.2013 13.1042 13.6041C12.7014 14.0069 12.5 14.5 12.5 15.0833C12.5 15.6666 12.7014 16.1597 13.1042 16.5625C13.5069 16.9652 14 17.1666 14.5833 17.1666ZM4.16667 16.75H7.5V13.4166H4.16667V16.75ZM8.375 7.99996H11.625L10 5.37496L8.375 7.99996Z"
      />
   </svg>`,

      searchIcon: y` <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="#fff">
      <path
         d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"
      />
   </svg>`,

      likeOutline: y` <svg width="20" height="19" viewBox="0 0 20 19" fill="#D2D2D2" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M10 18.9999L8.55 17.6999C6.86667 16.1832 5.475 14.8749 4.375 13.7749C3.275 12.6749 2.4 11.6872 1.75 10.8119C1.1 9.93724 0.646 9.13324 0.388 8.3999C0.129333 7.66657 0 6.91657 0 6.1499C0 4.58324 0.525 3.2749 1.575 2.2249C2.625 1.1749 3.93333 0.649902 5.5 0.649902C6.36667 0.649902 7.19167 0.833236 7.975 1.1999C8.75833 1.56657 9.43333 2.08324 10 2.7499C10.5667 2.08324 11.2417 1.56657 12.025 1.1999C12.8083 0.833236 13.6333 0.649902 14.5 0.649902C16.0667 0.649902 17.375 1.1749 18.425 2.2249C19.475 3.2749 20 4.58324 20 6.1499C20 6.91657 19.871 7.66657 19.613 8.3999C19.3543 9.13324 18.9 9.93724 18.25 10.8119C17.6 11.6872 16.725 12.6749 15.625 13.7749C14.525 14.8749 13.1333 16.1832 11.45 17.6999L10 18.9999ZM10 16.2999C11.6 14.8666 12.9167 13.6372 13.95 12.6119C14.9833 11.5872 15.8 10.6959 16.4 9.9379C17 9.17924 17.4167 8.5039 17.65 7.9119C17.8833 7.32057 18 6.73324 18 6.1499C18 5.1499 17.6667 4.31657 17 3.6499C16.3333 2.98324 15.5 2.6499 14.5 2.6499C13.7167 2.6499 12.9917 2.87057 12.325 3.3119C11.6583 3.7539 11.2 4.31657 10.95 4.9999H9.05C8.8 4.31657 8.34167 3.7539 7.675 3.3119C7.00833 2.87057 6.28333 2.6499 5.5 2.6499C4.5 2.6499 3.66667 2.98324 3 3.6499C2.33333 4.31657 2 5.1499 2 6.1499C2 6.73324 2.11667 7.32057 2.35 7.9119C2.58333 8.5039 3 9.17924 3.6 9.9379C4.2 10.6959 5.01667 11.5872 6.05 12.6119C7.08333 13.6372 8.4 14.8666 10 16.2999Z"
      />
   </svg>`,

      likeSolid: y` <svg width="20" height="18" viewBox="0 0 20 18" fill="#D2D2D2" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M8.65 17.15L6.925 15.575C5.15833 13.9583 3.56267 12.354 2.138 10.762C0.712667 9.17067 0 7.41667 0 5.5C0 3.93333 0.525 2.625 1.575 1.575C2.625 0.525 3.93333 0 5.5 0C6.38333 0 7.21667 0.187333 8 0.562C8.78333 0.937333 9.45 1.45 10 2.1C10.55 1.45 11.2167 0.937333 12 0.562C12.7833 0.187333 13.6167 0 14.5 0C16.0667 0 17.375 0.525 18.425 1.575C19.475 2.625 20 3.93333 20 5.5C20 7.41667 19.2917 9.175 17.875 10.775C16.4583 12.375 14.85 13.9833 13.05 15.6L11.35 17.15C10.9667 17.5 10.5167 17.675 10 17.675C9.48333 17.675 9.03333 17.5 8.65 17.15Z"
      />
   </svg>`,

      edit: y`
      <svg width="19" height="19" viewBox="0 0 19 19" fill="#D2D2D2" xmlns="http://www.w3.org/2000/svg">
         <path
            d="M2 16.25H3.4L12.025 7.625L10.625 6.225L2 14.85V16.25ZM16.3 6.175L12.05 1.975L13.45 0.575C13.8333 0.191667 14.3043 0 14.863 0C15.421 0 15.8917 0.191667 16.275 0.575L17.675 1.975C18.0583 2.35833 18.2583 2.821 18.275 3.363C18.2917 3.90433 18.1083 4.36667 17.725 4.75L16.3 6.175ZM1 18.25C0.716667 18.25 0.479333 18.154 0.288 17.962C0.0960001 17.7707 0 17.5333 0 17.25V14.425C0 14.2917 0.025 14.1627 0.075 14.038C0.125 13.9127 0.2 13.8 0.3 13.7L10.6 3.4L14.85 7.65L4.55 17.95C4.45 18.05 4.33767 18.125 4.213 18.175C4.08767 18.225 3.95833 18.25 3.825 18.25H1Z"
         />
      </svg>
   `,
      sort: y` <svg width="18" height="12" viewBox="0 0 18 12" fill="#E3E3E3" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M5 12H1C0.716667 12 0.479333 11.904 0.288 11.712C0.0960001 11.5207 0 11.2833 0 11C0 10.7167 0.0960001 10.4793 0.288 10.288C0.479333 10.096 0.716667 10 1 10H5C5.28333 10 5.521 10.096 5.713 10.288C5.90433 10.4793 6 10.7167 6 11C6 11.2833 5.90433 11.5207 5.713 11.712C5.521 11.904 5.28333 12 5 12ZM17 2H1C0.716667 2 0.479333 1.90433 0.288 1.713C0.0960001 1.521 0 1.28333 0 1C0 0.716667 0.0960001 0.479 0.288 0.287C0.479333 0.0956668 0.716667 0 1 0H17C17.2833 0 17.5207 0.0956668 17.712 0.287C17.904 0.479 18 0.716667 18 1C18 1.28333 17.904 1.521 17.712 1.713C17.5207 1.90433 17.2833 2 17 2ZM11 7H1C0.716667 7 0.479333 6.904 0.288 6.712C0.0960001 6.52067 0 6.28333 0 6C0 5.71667 0.0960001 5.479 0.288 5.287C0.479333 5.09567 0.716667 5 1 5H11C11.2833 5 11.521 5.09567 11.713 5.287C11.9043 5.479 12 5.71667 12 6C12 6.28333 11.9043 6.52067 11.713 6.712C11.521 6.904 11.2833 7 11 7Z"
      />
   </svg>`,
      checkCircle: y` <svg width="18" height="12" viewBox="0 0 18 12" fill="#E3E3E3" xmlns="http://www.w3.org/2000/svg">
      <path
         d="M8.83342 11.5L7.02091 9.68746C6.86814 9.53468 6.6773 9.4619 6.44841 9.46913C6.21897 9.47579 6.02786 9.55551 5.87508 9.70829C5.7223 9.86107 5.64591 10.0555 5.64591 10.2916C5.64591 10.5277 5.7223 10.7222 5.87508 10.875L8.25008 13.25C8.40286 13.4027 8.5973 13.4791 8.83342 13.4791C9.06953 13.4791 9.26397 13.4027 9.41675 13.25L14.1459 8.52079C14.2987 8.36801 14.3717 8.1769 14.3651 7.94746C14.3579 7.71857 14.2779 7.52774 14.1251 7.37496C13.9723 7.22218 13.7779 7.14579 13.5417 7.14579C13.3056 7.14579 13.1112 7.22218 12.9584 7.37496L8.83342 11.5ZM10.0001 18.3333C8.8473 18.3333 7.76397 18.1144 6.75008 17.6766C5.73619 17.2394 4.85425 16.6458 4.10425 15.8958C3.35425 15.1458 2.76064 14.2638 2.32341 13.25C1.88564 12.2361 1.66675 11.1527 1.66675 9.99996C1.66675 8.84718 1.88564 7.76385 2.32341 6.74996C2.76064 5.73607 3.35425 4.85413 4.10425 4.10413C4.85425 3.35413 5.73619 2.76024 6.75008 2.32246C7.76397 1.88524 8.8473 1.66663 10.0001 1.66663C11.1529 1.66663 12.2362 1.88524 13.2501 2.32246C14.264 2.76024 15.1459 3.35413 15.8959 4.10413C16.6459 4.85413 17.2395 5.73607 17.6767 6.74996C18.1145 7.76385 18.3334 8.84718 18.3334 9.99996C18.3334 11.1527 18.1145 12.2361 17.6767 13.25C17.2395 14.2638 16.6459 15.1458 15.8959 15.8958C15.1459 16.6458 14.264 17.2394 13.2501 17.6766C12.2362 18.1144 11.1529 18.3333 10.0001 18.3333ZM10.0001 16.6666C11.8473 16.6666 13.4204 16.0175 14.7192 14.7191C16.0176 13.4202 16.6667 11.8472 16.6667 9.99996C16.6667 8.15274 16.0176 6.57968 14.7192 5.28079C13.4204 3.98246 11.8473 3.33329 10.0001 3.33329C8.15286 3.33329 6.58008 3.98246 5.28175 5.28079C3.98286 6.57968 3.33341 8.15274 3.33341 9.99996C3.33341 11.8472 3.98286 13.4202 5.28175 14.7191C6.58008 16.0175 8.15286 16.6666 10.0001 16.6666Z"
      />
   </svg>`,
   };

   var animation = i`
   .drop-in-animation {
      animation: drop-in 0.2s cubic-bezier(0.15, 0.8, 0.3, 1.6);
      -webkit-animation: drop-in 0.2s cubic-bezier(0.15, 0.8, 0.3, 1.6);
      -moz-animation: drop-in 0.2s cubic-bezier(0.15, 0.8, 0.3, 1.6);
   }
   @keyframes drop-in {
      0% {
         opacity: 0;
         transform: translateY(-8px);
      }
      100% {
         opacity: 1;
         transform: translateY(0);
      }
   }
`;

   var style$1 = i`
   :host {
      position: relative;
   }
   #user-avatar {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
      cursor: pointer;
   }
   #user-name {
      font-size: 14px;
      font-weight: 400;
      color: var(--color-netural-700);
      max-width: 70px;
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
      min-width: 30px;
   }
   #user-avatar-image {
      position: relative;
      display: flex;
   }
   #premium-icon {
      position: absolute;
      top: -3px;
      right: -3px;
   }
   #user-avatar-image img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
   }
   #user-menu {
      position: absolute;
      margin-left: -100px;
      margin-top: 20px;
      height: max-content;
      height: -webkit-max-content;
      height: -moz-max-content;
      width: 230px;
      background: var(--color-netural-50);
      border-radius: 8px;
      box-shadow: 0px 3px 12px #00000012;
      border: 1px solid #e3e3e3;
      display: flex;
      flex-direction: column;
      overflow: hidden;
      z-index: 999;
   }
   #menu {
      padding: 16px 8px;
   }
   #menu ul {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 5px;
   }
   #menu a {
      text-decoration: none;
      color: var(--color-netural-800);
      display: block;
      padding: 8px 8px;
      border-radius: 6px;
      transition: all 0.2s ease-in-out;
   }
   #menu a:hover {
      background: var(--color-netural-100);
      color: var(--color-primary-300);
   }
   #social-bar {
      height: 40px;
      background-color: var(--color-netural-800);
   }
   #icon.up {
      transform: rotate(180deg);
      transition: all 0.1s ease-in-out;
   }
   #icon.dwn {
      transform: rotate(0deg);
      transition: all 0.1s ease-in-out;
   }

   @media (max-width: 768px) {
      #user-name {
         display: none;
      }
      #icon {
         display: none;
      }
   }
`;

   class user_avatar extends s$3 {
      static get styles() {
         return [style$1, animation, typo, buttons];
      }

      static get properties() {
         return {
            user: { type: Object },
            menu: { type: Array },
            showDropMenu: { type: Boolean },
         };
      }

      constructor() {
         super();
         this.user = {
            name: "",
            avatar: "",
            premium: false,
         };
         this.menu = [];
         this.showDropMenu = false;
      }

      render() {
         return y`
         <div id="user-avatar" @click="${(e) => this.handleDropIconClick(e)}">
            <div id="user-avatar-image">
               ${this.user.premium ? y`<div id="premium-icon">${pmst_icons.avatar_premium}</div>` : ""}
               <img id="avatar" src="https://premast.com/app/uploads/2022/09/Frame-438.svg" />
               ${this.loadAvatar()}
            </div>
            <div id="user-name">${this.user.name}</div>
            <div id="icon" class="${this.showDropMenu ? "up" : "dwn"}">${pmst_icons.arrow_down}</div>
         </div>
         ${this.showDropMenu ? this.renderDropMenu() : null}
      `;
      }

      firstUpdated() {
         console.log(this);
         // listen to click on page to close dropdown
         window.addEventListener("click", (e) => {
            let dropdown = this.shadowRoot.querySelector("#user-menu");
            let user_avatar = this.shadowRoot.querySelector("#user-avatar");
            let target = e.path[0];
            if (this.showDropMenu && !dropdown.contains(target) && !user_avatar.contains(target)) {
               this.showDropMenu = false;
            }
         });
      }
      handleDropIconClick(e) {
         this.showDropMenu = !this.showDropMenu;
      }
      renderDropMenu() {
         return y`
         <div id="user-menu" class="drop-in-animation">
            <div id="menu">
               <ul>
                  ${this.menu.map((item) => {
                     return y`
                        <li class="nav-text">
                           <a href="${item.link}">${item.name}</a>
                        </li>
                     `;
                  })}
                  <button class="btn-flat-normal" @click=${this.triggerLogoutEvent}>Logout</button>
               </ul>
            </div>
            <!-- <div id="social-bar"></div> -->
         </div>
      `;
      }
      triggerLogoutEvent(e) {
         this.dispatchEvent(new CustomEvent("logout", { bubbles: true, composed: true }));
      }

      beforeRender() {}

      loadAvatar() {
         let image = new Image();
         image.src = this.user.avatar;
         image.onload = () => {
            let avatarElement = this.shadowRoot.querySelector("#avatar");
            avatarElement.src = this.user.avatar;
         };
      }
   }

   if (!customElements.get("pmst-user-avatar")) {
      customElements.define("pmst-user-avatar", user_avatar);
   }

   var style$2 = i`
   :host {
   }
   .popup {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
   }
   #signin {
      background-color: var(--color-netural-50);
      height: auto;
      border-radius: 18px;
      display: flex;
      flex-direction: row;
      overflow: hidden;
      min-width: 300px;
      max-width: 800px;
      width: 75%;
      margin: 16px 16px;
   }
   #signin-left {
      height: 300px;
      background-image: linear-gradient(115deg, #1fa2ff, #274fdb);
      padding: 40px;
      color: #fff;
      max-width: 390px;
      box-sizing: border-box;
      height: auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      gap: 4px;
      box-sizing: border-box;
   }
   #signin-right {
      padding: 40px;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      gap: 24px;
   }
   ul {
      margin: 0;
      margin-top: 16px;
      padding: 12px;
   }
   #labels {
      display: flex;
      flex-direction: column;
      color: var(--color-netural-700);
      gap: 4px;
   }
   #signin-right form {
      width: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      gap: 20px;
   }
   .nav-text {
      color: var(--color-primary-400) !important;
      text-decoration: none;
      background-color: transparent;
      font-size: 14px;
      border: none;
   }

   .login-with-google-btn {
      transition: background-color 0.3s, box-shadow 0.3s;
      padding: 12px 16px 12px 42px;
      border: 1px solid var(--color-netural-300);
      border-radius: 50px;
      color: #757575;
      font-size: 14px;
      font-weight: 500;
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Fira Sans",
         "Droid Sans", "Helvetica Neue", sans-serif;
      background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
      background-color: white;
      background-repeat: no-repeat;
      background-position: 12px 11px;
      cursor: pointer;
   }
   .login-with-google-btn:hover {
      box-shadow: 0 -1px 0 rgba(0, 0, 0, 0.04), 0 2px 4px rgba(0, 0, 0, 0.16);
   }
   .error {
      color: var(--color-warning-100);
      background-color: var(--color-warning-50);
      padding: 8px;
      border-radius: 4px;
   }
   .success {
      color: var(--color-success-100);
      background-color: var(--color-success-50);
      padding: 8px;
      border-radius: 4px;
   }

   @media screen and (max-width: 480px) {
   }
   @media screen and (max-width: 768px) {
      #signin-left {
         display: none;
      }
   }
   @media screen and (max-width: 992px) {
   }
   @media screen and (max-width: 1200px) {
   }
`;

   var inputStyle = i`
   input {
      border: 1px solid var(--color-netural-300);
      border-radius: 100px;
      padding: 12px 16px;
      font-size: 14px;
      font-weight: 400;
      line-height: 18px;
      color: var(--color-netural-700);
      background-color: #fff;
   }
   input[type="text"] {
   }
`;

   class signin extends s$3 {
      static get styles() {
         return [style$2, animation, typo, inputStyle, buttons];
      }
      static get properties() {
         return {
            signIn: { type: Boolean },
            signInValue: { type: Object },
            signUpValue: { type: Object },
            loading: { type: Boolean },
            error: { type: String },
            success: { type: String },
            forgetPassLink: { type: String },
            ActiveForm: { type: String },
         };
      }
      constructor() {
         super();
         this.ActiveForm = "signin";
         this.loading = false;
         this.forgetPassLink = "https://www.google.com/maps/place";
      }
      render() {
         return y`
         <div id="signin-outer" class="popup" @click=${this.closePopup}>
            ${this.ActiveForm === "signin" ? this.renderSignIn() : null}
            ${this.ActiveForm === "signup" ? this.renderSignUp() : null}
            ${this.ActiveForm === "lostpass" ? this.renderSignIn() : null}
         </div>
      `;
      }
      closePopup(e) {
         if (e.target.id === "signin-outer") {
            this.dispatchEvent(new CustomEvent("close"));
         }
      }
      renderSignIn() {
         //SECTION - Sign In Form template
         let signInForm = y` <form @submit=${this.submitSignIn} id="signin-form">
         <input type="email" name="email" placeholder="Email" required="" />
         <input type="password" name="pswd" placeholder="Password" required="" />
         <button href="#" class="nav-text" @click=${(e) => (this.ActiveForm = "lostpass")}>Forgot password?</button>
         <button class="btn-primary-large" .disabled=${this.loading}>Sign in</button>
         <button type="button" class="login-with-google-btn" @click=${this.signInWithGoogle}>
            Sign in with Google
         </button>
         <button href="#" class="nav-text" @click=${(e) => (this.ActiveForm = "signup")}>
            Don't have an account? Sign Up
         </button>
      </form>`;

         //SECTION - forgot password form template
         let lostPassForm = y` <form @submit=${this.submitLostPass} id="signin-form">
         <input type="email" name="email" placeholder="Email" required="" />
         <button class="btn-primary-large" .disabled=${this.loading}>Reset Password</button>
      </form>`;

         //SECTION - render the form based on the active form
         return y`
         <div id="signin">
            <div id="signin-left">
               <h3 style="margin-bottom: 16px;">Welcome to Premast Templates</h3>
               <h5>
                  Download your preferred design from huge collection of professionally, creative designed powerpoint
                  templates for all your needs.
               </h5>
            </div>
            <div id="signin-right">
               <div id="labels">
                  <h3>${this.ActiveForm === "signin" ? "sign in" : "Rest your password"}</h3>
               </div>
               ${this.error ? y`<h6 class="error">${this.error}</h6>` : ""}
               ${this.success ? y`<h6 class="success">${this.success}</h6>` : ""}
               ${this.ActiveForm === "signin" ? signInForm : null}
               ${this.ActiveForm === "lostpass" ? lostPassForm : null}
            </div>
         </div>
      `;
      }
      renderSignUp() {
         return y`
         <div id="signin">
            <div id="signin-left">
               <h3>Welcome to Premast Templates</h3>
               <h5>Join us and enjoy these benefits:</h5>
               <ul>
                  <li><h5>a 20% off discount in your E-mail</h5></li>
                  <li><h5>Downloads hundreds of powerpoint templates and graphics.</h5></li>
                  <li><h5>Discover amazing new products daily</h5></li>
               </ul>
            </div>
            <div id="signin-right">
               <div id="labels">
                  <h3>Sign Up</h3>
                  <h5>It's free and always will be.</h5>
               </div>
               ${this.error ? y`<p class="error">${this.error}</p>` : ""}
               <form @submit=${this.submitSignUp} id="signin-form">
                  <input type="text" name="name" placeholder="Full name" required="" />
                  <input type="email" name="email" placeholder="Email" required="" />
                  <input type="password" name="pswd" placeholder="Password" required="" />
                  <input type="password" name="confirm-pswd" placeholder="Confirm password" required="" />
                  <button class="btn-primary-large" .disabled=${this.loading}>Sign Up</button>
                  <button type="button" class="login-with-google-btn" @click=${this.signInWithGoogle}>
                     Sign up with Google
                  </button>
                  <button class="nav-text" @click=${(e) => (this.ActiveForm = "signin")}>
                     Already have an account? Sign In
                  </button>
               </form>
            </div>
         </div>
      `;
      }
      toggleSignIn() {
         this.signIn = !this.signIn;
         this.error = "";
      }
      submitSignIn(e) {
         this.loading = true;
         e.preventDefault();
         const form = e.target;
         const email = form.email.value;
         const password = form.pswd.value;
         this.signInValue = { email, password };
         this.dispatchEvent(new CustomEvent("signin", { detail: this.signInValue, bubbles: true, composed: true }));
      }
      submitSignUp(e) {
         this.loading = true;
         e.preventDefault();
         const form = e.target;
         const name = form.name.value;
         const email = form.email.value;
         const password = form.pswd.value;
         const confirmPassword = form["confirm-pswd"].value;
         this.signUpValue = { name, email, password, confirmPassword };
         this.dispatchEvent(new CustomEvent("signup", { detail: this.signUpValue, bubbles: true, composed: true }));
      }
      submitLostPass(e) {
         this.loading = true;
         e.preventDefault();
         const form = e.target;
         const email = form.email.value;
         //SECTION - fetch forget pass API here
         let url = "https://premast.com/wp-json/pmst/v1/users/reset-pass";
         let data = { email };
         fetch(url, {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
         }).then((res) => {
            this.loading = false;
            console.log(res);
            if (res.status === 200) {
               this.ActiveForm = "signin";
               this.success = "Password reset link has been sent to your email";
            } else {
               this.error = "Something went wrong";
            }
         });
      }
      signInWithGoogle() {
         this.dispatchEvent(new CustomEvent("google-signin", { bubbles: true, composed: true }));
      }
   }
   ///////// end of components //////////
   if (customElements.get("pmst-signin") === undefined) {
      customElements.define("pmst-signin", signin);
   }

   var mainStyle = i`
   ${colors}
   #more-dropdown {
      background-color: white;
      border-radius: 20px;
      box-shadow: 0 2px 20px 0 #22212924;
      z-index: 100;
      display: flex;
      flex-direction: row;
      overflow: hidden;
      min-width: 560px;
   }
   #left {
      min-width: 225px;
      background-color: #eef0f3;
      min-height: fit-content;
      min-height: -webkit-fit-content;
      min-height: -moz-fit-content;
      display: flex;
      flex-direction: column;
   }
   #left ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      height: 100%;
   }
   #left li {
      min-height: fit-content;
      min-height: -webkit-fit-content;
      min-height: -moz-fit-content;
   }
   #tab {
      display: flex;
      flex-direction: column;
      align-items: left;
      cursor: pointer;
      padding: 16px 24px;
      gap: 6px;
   }
   #tab:hover,
   #tab.active {
      background-color: #e7eaee;
      transition: all 0.2s ease-in-out;
   }
   #tab-logo {
      height: 17px;
      object-fit: contain;
      align-self: flex-start;
   }
   #tab h3 {
      font-size: 16px;
      font-family: "Roboto";
      font-weight: 500;
      color: var(--color-netural-700);
      margin: 0;
   }
   #tab p {
      font-size: 13px;
      font-family: "Roboto";
      font-weight: 400;
      color: var(--color-netural-700);
      margin: 0;
      opacity: 0.7;
      line-height: 1.4;
      margin-top: 4px;
   }
   #right {
      min-height: fit-content;
      min-height: -webkit-fit-content;
      min-height: -moz-fit-content;
      padding: 24px 32px;
   }
   #right p {
      font-size: 14px;
      font-family: "Roboto";
      font-weight: 300;
      color: var(--color-netural-600);
      margin: 0;
      padding: 0;
   }

   //////////// details templates styles ////////////
   #details {
      background-color: #eef0f3;
      display: flex;
      flex-direction: column;
      gap: 16px;
      min-height: fit-content;
      min-height: -webkit-fit-content;
      min-height: -moz-fit-content;
      height: 100%;
   }
   #details > a {
      color: var(--color-primary-300);
      margin-top: 16px;
      display: block;
      text-decoration: none;
   }
   #details > video {
      width: 100%;
      margin-top: 16px;
      box-sizing: border-box;
      border-radius: 8px;
   }
   #details > .ytube-video {
      position: relative;
      overflow: hidden;
      margin-top: 16px;
   }
   .ytube-video iframe {
      width: 98%;
      height: 100%;
      border-radius: 8px;
      border: 1px solid var(--color-netural-300);
   }
   #details > .plugin-link {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
   }
   .plugin-link > img {
      height: 16px;
   }
   #template-wrapper {
      display: flex;
      flex-direction: column;
      gap: 16px;
   }
   #featured-templates {
      display: flex;
      max-width: 471px;
      overflow-y: auto;
      gap: 16px;
      padding-bottom: 8px;
   }
   #featured-templates::-webkit-scrollbar {
      background-color: transparent;
      height: 2px;
   }
   #featured-templates:hover::-webkit-scrollbar {
      background-color: #eef0f3;
      border-radius: 8px;
      height: 4px;
   }

   #featured-templates::-webkit-scrollbar-thumb {
      background-color: var(--color-netural-300);
   }
   #featured-templates a {
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      width: 200px;
      height: 160px;
   }
   #featured-templates a img {
      width: 100%;
      object-fit: cover;
   }
   .btn-flat-normal {
      text-decoration: none;
      font-size: 14px;
      font-family: "Roboto";
      font-weight: 500;
      color: var(--color-primary-300);
      max-width: max-content;
   }
`;

   async function getFeaturedTemplates() {
      // fetch templates with query
      let templates = [];
      let params = new URLSearchParams({
         orderby: "popular",
         order: "DESC",
         category: 884,
         limit: 10,
      });
      const response = await fetch("https://premast.com/wp-json/pmst/v1/products??" + params);
      const data = await response.json();
      data.forEach((item) => {
         templates.push({
            name: item.title,
            link: "https://premast.com/product/" + item.slug,
            image: item.image.medium,
         });
      });

      return templates;
   }

   class PMST_MoreDropdown extends s$3 {
      static get styles() {
         return [mainStyle, buttons];
      }
      static get properties() {
         return {
            source: { type: String },
            data: { type: Array },
            selected: { type: Object },
            featuredTemplates: { type: Array },
         };
      }
      constructor() {
         super();
         this.featuredTemplates = [];
         this.data = [
            {
               name: "templates",
               activeOn: ["premast", "plus"],
               logo: "https://premast.com/app/uploads/2021/05/Group-483.svg",
               desc: "to empower your business and deliver your ideas.",
               details: y`<div id="template-wrapper">
               <p>
                  Premast enables you to design stunning presentations in a snap and easily get experts’ outcomes
                  without any design experience.
               </p>
               <div id="featured-templates">${this.featuredTemplates}</div>
               <a href="https://premast.com/templates" target="blank" class="btn-flat-normal">View all templates</a>
            </div>`,
            },
            {
               name: "plus",
               activeOn: ["premast", "templates"],
               logo: "https://dd7tel2830j4w.cloudfront.net/f1624633173347x601060463974310300/LOGO.svg",
               title: null,
               desc: "Create presentation with absolute ease!",
               details: y` <div id="details">
               <p>
                  Premast enables you to design stunning presentations in a snap and easily get experts' outcomes
                  without any design experience.
               </p>
               <video id="plus-video" autoplay loop muted>
                  <source
                     src="https://s3.amazonaws.com/appforest_uf/f1616201005189x234601325706508030/collection.mp4"
                     type="video/mp4"
                  />
               </video>
               <a href="https://plus.premast.com" target="blank">Signup for Free</a>
            </div>`,
            },
            {
               name: "studio",
               activeOn: ["premast", "templates"],
               logo: "https://premast.com/app/uploads/2022/09/studio.svg",
               title: null,
               desc: "We Create Neat, Professional & Amazing Presentations",
               details: y`<div id="details">
               <p>
                  Hire our most talented design team to design your next presentation and make it mind-blowing! Or you
                  can get custom branded fully editable templates; you can just change the color, size or even use
                  different graphics from our platform
               </p>
               <a href="https://studio.premast.com/">Get your design now </a>
            </div> `,
            },
            {
               name: "plugins",
               activeOn: ["premast", "templates"],
               logo: null,
               title: "Plugins",
               desc: "All in one place, no more hassle!",
               details: y`
               <div id="details">
                  <p>
                     Instant access to thousands of design assets to build unique presentations inside google Slides and
                     PowerPoint.
                  </p>
                  <body>
                     <div class="ytube-video">
                        <iframe
                           src="https://www.youtube.com/embed/K6byIIACesQ?controls=0&autoplay=1&loop=1&controls=0&playlist=K6byIIACesQ&modestbranding=1"
                           title="YouTube video player"
                           frameborder="0"
                           allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                           allowfullscreen
                        ></iframe>
                     </div>
                  </body>
                  <a
                     href="https://appsource.microsoft.com/en-us/product/office/wa200001396?tab=overview"
                     class="plugin-link"
                  >
                     <img src="https://dd7tel2830j4w.cloudfront.net/f1645371424979x766959018108208600/fi-ppt.svg" />
                     <span>Install Plus on PowerPoint</span>
                  </a>
                  <a href="https://workspace.google.com/marketplace/app/premast_plus/317742893171" class="plugin-link">
                     <img src="https://dd7tel2830j4w.cloudfront.net/f1645371432338x363138609305044800/fi-Gsuit.svg" />
                     <span>Install Plus on Google Slides</span>
                  </a>
               </div>
            `,
            },
         ];
      }
      firstUpdated() {
         /// get any data from api if needed
         getFeaturedTemplates().then((res) => {
            this.featuredTemplates = res;
            let data = [...this.data];
            data[0].details = y` <div id="template-wrapper">
            <p>
               Premast enables you to design stunning presentations in a snap and easily get experts’ outcomes without
               any design experience.
            </p>
            <div id="featured-templates">
               ${this.featuredTemplates.map(
                  (item) => y`<div class="featured-template">
                     <a href="${item.link}" target="blank">
                        <img src="${item.image}" />
                     </a>
                  </div>`
               )}
            </div>
            <a href="https://premast.com/templates" target="blank" class="btn-flat-normal">View all templates</a>
         </div>`;
            this.data = data;
            console.log(this.data);
            // create a new copy of data array
         });
      }
      render() {
         return y`
         <div id="more-dropdown">
            <div id="left">
               <ul id="tab-list">
                  ${this.data.map((item, i) => {
                     if (item.activeOn.includes(this.source)) {
                        if (!this.selected) this.selected = item;
                        return y`
                           <li>
                              <div
                                 id="tab"
                                 class=${this.selected == item ? "active" : ""}
                                 @click=${() => this.tabClick(item)}
                              >
                                 ${item.logo ? y`<img id="tab-logo" src="${item.logo}" />` : null}
                                 ${item.title ? y`<h3>${item.title}</h3>` : null}
                                 <p>${item.desc}</p>
                              </div>
                           </li>
                        `;
                     }
                  })}
               </ul>
            </div>
            <div id="right">
               ${this.selected
                  ? y` <div id="selected">${this.selected.details ? this.selected.details : null}</div> `
                  : null}
            </div>
         </div>
      `;
      }
      tabClick(item) {
         console.log(item);
         this.selected = item;
      }
   }
   if (!customElements.get("pmst-more-dropdown")) {
      customElements.define("pmst-more-dropdown", PMST_MoreDropdown);
   }

   var style$3 = i`
   ${colors}
   #humburger-icon {
      display: flex;
      flex-direction: column;
      gap: 4px;
   }
   #humburger-icon .line {
      width: 24px;
      height: 3px;
      background-color: var(--color-netural-700);
      display: block;
      -webkit-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
   }
   #humburger-icon.active .line:nth-child(2) {
      opacity: 0;
   }

   #humburger-icon.active .line:nth-child(1) {
      -webkit-transform: translateY(7px) rotate(45deg);
      -ms-transform: translateY(7px) rotate(45deg);
      -o-transform: translateY(7px) rotate(45deg);
      transform: translateY(7px) rotate(45deg);
   }

   #humburger-icon.active .line:nth-child(3) {
      -webkit-transform: translateY(-7px) rotate(-45deg);
      -ms-transform: translateY(-7px) rotate(-45deg);
      -o-transform: translateY(-7px) rotate(-45deg);
      transform: translateY(-7px) rotate(-45deg);
   }

   #dropdown {
      height: 100vh;
      width: 100vw;
      background-color: white;
      position: fixed;
      top: 72px;
      left: 0;
      z-index: 999;
      overflow-y: auto;
      -webkit-transition: all 0.3s ease-in-out;
      -o-transition: all 0.3s ease-in-out;
      transition: all 0.3s ease-in-out;
      animation: slideIn 0.2s ease-in-out;
   }
   @keyframes slideIn {
      0% {
         transform: scaleY(0.5);
         opacity: 0;
      }
      20% {
         opacity: 0;
      }
      100% {
         transform: scaleY(1);
         opacity: 1;
      }
   }

   #dropdown ul {
      display: flex;
      flex-direction: column;
      list-style: none;
      margin: 0;
      padding: 0;
   }
   #dropdown li {
      margin: 0px;
      padding: 16px 24px;
      text-decoration: none;
   }
   #dropdown li a {
      text-decoration: none;
      color: var(--color-netural-700);
   }
   #dropdown li:hover {
      background-color: var(--color-netural-100);
   }
`;

   class pmstHumburger extends s$3 {
      static get styles() {
         return [style$3, typo];
      }

      static get properties() {
         return {
            active: { type: Boolean },
            nav: { type: Array },
         };
      }

      constructor() {
         super();
         this.name = "pmst-humburger";
         this.nav = [];
      }

      render() {
         return y`
         <div id="humburger-icon" class=${this.active ? "active" : ""} @click=${this.toggleHumurger}>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
         </div>

         ${this.active ? this.renderNav() : ""}
      `;
      }
      toggleHumurger() {
         this.active = !this.active;
         document.body.style.overflow = this.active ? "hidden" : "auto";
      }
      renderNav() {
         return y` <div id="dropdown">
         <div id="dropdown-content">
            <ul>
               ${this.nav.map(
                  (item) => y`
                     <li class="nav-text">
                        <a href="${item.link}">${item.name}</a>
                     </li>
                  `
               )}
            </ul>
         </div>
      </div>`;
      }
   }
   if (!customElements.get("pmst-humburger")) {
      customElements.define("pmst-humburger", pmstHumburger);
   }

   var style$4 = i`
   .search__box {
      display: flex;
      background-color: var(--color-netural-50);
      border-radius: 50px;
      border: 1px solid var(--color-netural-100);

      transition: all 0.3188s cubic-bezier(0.77, 0, 0.18, 1);
   }

   .search-icon {
      border-radius: 50px;
      border: 1px solid var(--color-netural-200);
      background-color: var(--color-netural-50);
      width: 35px;
      height: 35px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      box-sizing: border-box;
      transition: all 0.3188s ease-in-out;
   }
   .search-icon:hover {
      background-color: var(--color-netural-200);
   }
   .search-icon svg {
      fill: var(--color-netural-400);
      width: 15px;
      height: 15px;
   }
   .search-icon:hover svg {
      fill: var(--color-netural-700);
   }
   .search-icon .search-bar {
      height: 100%;
      background-color: transparent;
      border-radius: 0 15px 15px 0;
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      opacity: 0;
      transition: all 0.3188s cubic-bezier(0.77, 0, 0.18, 1);
   }

   .search-input {
      width: 100%;
      height: 100%;
      border: none;
      font-size: 16px;
      font-family: "Roboto", sans-serif;
      font-weight: 400;
      color: var(--color-netural-600);
      outline: none;
      background-color: transparent;
      box-sizing: border-box;
   }

   .close-icon {
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 600;
      height: 100%;
   }

   .close-icon svg {
      cursor: pointer;
   }

   .active__icon {
      cursor: auto;
      background-color: transparent;
      border: unset !important;
   }
   .active__icon svg {
      fill: var(--color-netural-500);
   }

   .active__bar {
      display: flex;
      opacity: 1;
      padding: 0 10px;
      animation: open 0.2s cubic-bezier(0.55, 0.055, 0.675, 0.19);
      width: 100%;
   }

   .active__box {
      background-color: #fff;
      width: 450px;
   }

   @keyframes open {
      0% {
         width: 0;
      }
      100% {
         width: 250px;
      }
   }
`;

   class searchBox extends s$3 {
      static get styles() {
         return [style$4];
      }
      static get properties() {
         return {
            open: { type: Boolean },
         };
      }
      constructor() {
         super();
         this.search = "";
         this.searchList = [];
         this.showSearch = false;
      }
      render() {
         return y`
         <div class="search__box">
            <div class="search-icon ${this.open ? "active__icon" : ""}" @click=${this.showSearchBox}>
               ${pmst_icons.searchIcon}
            </div>
            ${this.open ? this.renderSearchInput() : ""}
         </div>
      `;
      }

      showSearchBox() {
         this.open = !this.open;
      }
      renderSearchInput() {
         return y`
         <div class="search-bar active__bar">
            <input type="text" class="search-input" maxlength="17" @change=${this.searchInput} />
            <div class="close-icon">
               <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                     d="M6.2253 4.81108C5.83477 4.42056 5.20161 4.42056 4.81108 4.81108C4.42056 5.20161 4.42056 5.83477 4.81108 6.2253L10.5858 12L4.81114 17.7747C4.42062 18.1652 4.42062 18.7984 4.81114 19.1889C5.20167 19.5794 5.83483 19.5794 6.22535 19.1889L12 13.4142L17.7747 19.1889C18.1652 19.5794 18.7984 19.5794 19.1889 19.1889C19.5794 18.7984 19.5794 18.1652 19.1889 17.7747L13.4142 12L19.189 6.2253C19.5795 5.83477 19.5795 5.20161 19.189 4.81108C18.7985 4.42056 18.1653 4.42056 17.7748 4.81108L12 10.5858L6.2253 4.81108Z"
                     fill="currentColor"
                  />
               </svg>
            </div>
         </div>
      `;
      }

      searchInput(e) {
         let input = e.target;
         //check if input still focused
         if (this.shadowRoot.activeElement === input) {
            this.search = input.value;
            this.searchList = this.search.split(" ");
            // trigger custom event
            this.dispatchEvent(new CustomEvent("search", { detail: this.search, bubbles: true, composed: true }));
         }
      }

      updated() {
         console.log("Updated searchBox");
         if (this.open) {
            let searchInput = this.shadowRoot.querySelector(".search-input");
            searchInput.focus();
            searchInput.addEventListener(
               "blur",
               () => {
                  this.open = false;
               },
               false
            );
         }
      }
   }
   if (!customElements.get("pmst-search-box")) {
      customElements.define("pmst-search-box", searchBox);
   }

   class PMST_Header extends s$3 {
      static get styles() {
         return [style, buttons, typo, animation];
      }

      static get properties() {
         return {
            title: { type: String },
            logo: { type: String },
            navList: { type: Array },
            upgradeLink: { type: String },
            userMenu: { type: Array },
            userIsLogin: { type: Boolean },
            user: { type: Object },
            showSignin: { type: Boolean },
            signIn: { type: Boolean },
            forgetPassLink: { type: String }, // send this link to signin componenets
            showMore: { type: Boolean },
            width: { type: Number }, // used internal for responsive design logic
         };
      }

      constructor() {
         super();
         this.title = "My app";
         this.navList = [{ name: "Home", link: "/" }];
         this.userIsLogin = false;
         this.userMenu = []; //
         this.signIn = false;
         this.showMore = false;
         this.user = {}; //
      }

      render() {
         return y`
         <div id="header-top">
            <div id="header-top-left">
               ${this.width < 992
                  ? y`<pmst-humburger id="humbuger" .nav=${this.navList}>${pmst_icons.humbuger_icon}</pmst-humburger>`
                  : ""}
               <a href="https://premast.com/templates" id="logo-link">
                  <img id="logo" src="${this.logo}" alt="premast templates logo" title="premast templates" />
               </a>

               ${this.width > 992 && this.renderNav()}
            </div>
            <div id="header-top-right">
               <pmst-search-box id="search"> </pmst-search-box>
               ${!this.user.premium
                  ? y`
                       <a href="${this.upgradeLink}">
                          <button id="upgrade" class="btn-primary-normal" @click=${this.upgrade}>Pricing</button>
                       </a>
                    `
                  : ""}
               ${this.renderLogin()}
            </div>
         </div>
         ${this.showSignin
            ? y`<pmst-signin
                 @close=${this.toggleSignin}
                 .signIn=${this.signIn}
                 forgetPassLink=${this.forgetPassLink}
              ></pmst-signin>`
            : ""}
      `;
      }
      firstUpdated() {
         window.addEventListener("click", (e) => {
            let moreDropdown = this.shadowRoot.querySelector("#more-menu");
            let moreDropdownBtn = this.shadowRoot.querySelector("#more");
            let target = e.path[0];
            if (!e.path.includes(moreDropdownBtn) && !e.path.includes(moreDropdown)) {
               this.showMore = false;
            }
         });
         this.width = window.innerWidth;
         window.addEventListener("resize", (e) => {
            this.width = window.innerWidth;
         });
      }
      renderNav() {
         return y` <ul>
         ${this.navList.map(
            (item) => y`
               <li class="nav-text">
                  <a href="${item.link}">${item.name}</a>
               </li>
            `
         )}

         <!-- <li id="more-wrapper">
            <a
               href="#"
               id="more"
               @click=${function (e) {
            e.preventDefault();
            this.showMore = !this.showMore;
         }}
            >
               <div class="nav-text">more</div>
               <div id="more-icon">${pmst_icons.more_icon}</div>
            </a>
            ${this.showMore
            ? y`<pmst-more-dropdown
                 source="templates"
                 id="more-menu"
                 class="drop-in-animation"
              ></pmst-more-dropdown>`
            : ""}
         </li> -->
      </ul>`;
      }
      renderUser() {
         return y`
         <div id="user">
            <pmst-user-avatar
               class="drop-in-animation"
               .user=${this.user}
               .menu=${this.userMenu}
               @logout=${this.triggerLogout}
            ></pmst-user-avatar>
         </div>
      `;
      }
      renderLogin() {
         return y`
         <div id="sign-buttons">
            <button
               id="signin"
               class="btn-flat-normal"
               @click=${(e) => window.open("https://app.premast.com/login", "_blank")}
            >
               Log in
            </button>
            ${this.width > 992 &&
            y`<button
               id="signup"
               class="btn-flat-normal"
               @click=${(e) => window.open("https://app.premast.com/signup", "_blank")}
            >
               Sign up
            </button>`}
         </div>
      `;
      }
      // triggerLogout() {}
      toggleSignin(e) {
         this.showSignin = !this.showSignin;
         if (e.target.id === "signin") {
            this.signIn = true;
         }
         if (e.target.id === "signup") {
            this.signIn = false;
         }
      }
      signinError(message) {
         let signin = this.shadowRoot.querySelector("pmst-signin");
         signin.error = message;
         signin.loading = false;
      }
      signinSuccess() {
         let signin = this.shadowRoot.querySelector("pmst-signin");
         signin.error = "";
         signin.loading = false;
      }
      upgrade() {
         window.location.href = this.upgradeLink;
      }
   }

   if (!customElements.get("pmst-header")) {
      customElements.define("pmst-header", PMST_Header);
   }

   const styles$1 = i`
   ${colors}
   :host {
      height: 100%;
      width: 100%;
   }
   a {
      text-decoration: none;
      color: inherit;
   }
   .item-card {
      display: flex;
      min-height: 100px;
      min-width: 100px;
      height: 100%;
      flex-direction: column;
      align-items: stretch;
      background-color: #fff;
      border: 1px solid var(--color-netural-100);
      border-radius: 20px;
      box-sizing: border-box;
      overflow: hidden;
   }
   .item-card:hover {
      transition: all 0.2s ease-in-out;
   }

   .item-card-body {
      object-fit: cover;
      flex: 1;
      position: relative;
      border-radius: 10px;
      overflow: hidden;
      margin: 8px;
   }
   .overlay {
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      opacity: 0;
      position: absolute;
      transition: opacity 0.2s ease-in-out;
   }
   .overlay:hover {
      opacity: 1;
      transition: opacity 0.2s ease-in-out;
      backdrop-filter: blur(2px);
      -webkit-backdrop-filter: blur(2px);
      -moz-backdrop-filter: blur(2px);
      /* Note: backdrop-filter has minimal browser support */
   }
   .overlay #buttons {
      display: flex;
      flex-direction: column;
      justify-content: right;
      align-items: flex-end;
      position: absolute;
      right: 0;
   }
   .overlay a {
      width: 100%;
      height: 100%;
      display: block;
   }
   .overlay #buttons button {
      margin: 8px;
      padding: 8px;
      border: none;
      border-radius: 8px;
      background-color: #fff;
      width: 32px;
      height: 32px;
      cursor: pointer;
   }
   .overlay #buttons button svg {
      width: 100%;
      height: 100%;
      fill: var(--color-primary-300);
   }
   .item-card-body img {
      object-fit: cover;
      width: 100%;
      height: 100%;
      border-radius: 10px;
      /* height: -webkit-fill-available; */
   }
   .item-card-footer {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-end;
   }
   .item-card-footer h6 {
      font-size: 15px;
      font-weight: 400;
      margin: 0px;
      margin-bottom: 10px;
      width: 100%;
      overflow: hidden;
      text-overflow: ellipsis;
      line-height: 1.2;
      color: var(--color-netural-700);
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
   }
   .premium-tag {
      position: absolute;
      background-color: #ffb800;
      border-radius: 80px;
      padding: 2px 6px;
      font-size: 12px;
      font-family: "Roboto", sans-serif;
      top: 10px;
      left: 10px;
   }
   .premium {
      display: flex;
      flex-direction: row;
      align-items: flex-end;
   }
   .icon.premium {
      width: 15%;
      height: auto;
   }
   .premium svg {
      width: 100%;
   }
   .item-card-info-left {
      padding: 8px;
      width: 85%;
      box-sizing: border-box;
   }

   .item-card-info {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
      font-size: 12px;
      font-weight: 400;
      gap: 12px;
      font-family: "Roboto", sans-serif;
   }
   .info {
      display: flex;
      flex-direction: row;
      gap: 4px;
   }
   .icon {
      width: 12px;
   }
`;

   const icons = {
      star: y`<svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24">
      <path
         d="M6.852,23.438a3.612,3.612,0,0,1-2.121-.7A3.57,3.57,0,0,1,3.4,18.684L4.57,15.065,1.49,12.813A3.625,3.625,0,0,1,3.63,6.261H7.4l1.145-3.57a3.627,3.627,0,0,1,6.906,0h0L16.6,6.261H20.37a3.625,3.625,0,0,1,2.139,6.552L19.43,15.065,20.6,18.684A3.626,3.626,0,0,1,15,22.719l-3-2.206L9,22.72A3.619,3.619,0,0,1,6.852,23.438ZM3.63,9.261a.626.626,0,0,0-.37,1.131l3.956,2.891a1.5,1.5,0,0,1,.542,1.672l-1.5,4.65a.626.626,0,0,0,.966.7l3.889-2.861a1.5,1.5,0,0,1,1.778,0l3.889,2.86a.625.625,0,0,0,.966-.7l-1.5-4.65a1.5,1.5,0,0,1,.542-1.672l3.955-2.891a.626.626,0,0,0-.369-1.131H15.5a1.5,1.5,0,0,1-1.428-1.042L12.6,3.607a.626.626,0,0,0-1.192,0L9.925,8.219A1.5,1.5,0,0,1,8.5,9.261Z"
      />
   </svg> `,

      premium: y`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 58 57">
      <path
         fill-rule="evenodd"
         clip-rule="evenodd"
         d="M58 0L0 57H50C54.4183 57 58 53.4183 58 49V0ZM43.2451 35.9098L41 29L38.7549 35.9098H31.4894L37.3673 40.1803L35.1221 47.0902L41 42.8197L46.8779 47.0902L44.6327 40.1803L50.5106 35.9098H43.2451Z"
      />
   </svg>`,

      download: y`
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
         <path
            d="M15.443,13.388l-3.299,3.342c-.354,.359-.934,.359-1.288,0l-3.299-3.342c-.509-.515-.144-1.388,.58-1.388h1.863v-1.5c0-.828,.671-1.5,1.5-1.5s1.5,.672,1.5,1.5v1.5h1.863c.724,0,1.089,.873,.58,1.388Zm8.557,1.089c0,4.158-3.364,7.522-7.5,7.522H5.5c-3.033,0-5.5-2.467-5.5-5.5,0-1.676,.709-3.322,1.897-4.402,.115-.104,.181-.25,.161-.353-.188-.967-.199-1.959-.034-2.952,.559-3.366,3.184-6.04,6.533-6.652,3.675-.671,7.344,1.195,8.929,4.54,.06,.126,.175,.212,.325,.242,3.585,.715,6.188,3.892,6.188,7.555Zm-3,.022c0-2.259-1.588-4.199-3.777-4.636-1.087-.218-1.978-.909-2.447-1.897-.878-1.853-2.687-2.966-4.686-2.966-.327,0-.659,.029-.992,.091-2.076,.38-3.768,2.104-4.114,4.193-.106,.639-.1,1.274,.02,1.888,.219,1.13-.198,2.335-1.088,3.145-.556,.506-.916,1.362-.916,2.183,0,1.379,1.122,2.5,2.5,2.5h11c2.481,0,4.5-2.019,4.5-4.5Z"
         />
      </svg>
   `,

      like: y`
      <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24">
         <path
            d="M17.25,1.851A6.568,6.568,0,0,0,12,4.558,6.568,6.568,0,0,0,6.75,1.851,7.035,7.035,0,0,0,0,9.126c0,4.552,4.674,9.425,8.6,12.712a5.29,5.29,0,0,0,6.809,0c3.922-3.287,8.6-8.16,8.6-12.712A7.035,7.035,0,0,0,17.25,1.851ZM13.477,19.539a2.294,2.294,0,0,1-2.955,0C5.742,15.531,3,11.736,3,9.126A4.043,4.043,0,0,1,6.75,4.851,4.043,4.043,0,0,1,10.5,9.126a1.5,1.5,0,0,0,3,0,4.043,4.043,0,0,1,3.75-4.275A4.043,4.043,0,0,1,21,9.126C21,11.736,18.258,15.531,13.477,19.539Z"
         />
      </svg>
   `,
   };

   class pmstItemCard extends s$3 {
      static get properties() {
         return {
            loadedImage: { type: String },
            image: { type: String },
            title: { type: String },
            rating: { type: Number },
            downloads: { type: Number },
            likes: { type: Number },
            link: { type: String },
            editPermission: { type: Boolean },
            isLiked: { type: Boolean },
            premium: { type: Boolean },
         };
      }
      static get styles() {
         return [styles$1, typo];
      }
      constructor() {
         super();
         this.image =
            "https://cdn-copba.nitrocdn.com/PdwfBLhedhcVTEfwjMUvRQNSKonlJnAD/assets/static/optimized/app/uploads/2020/07/51971718a54578a3bf541b2dbb563bd4.dashiweb-300x257.png";
         this.title = "Item Card";
         this.rating = 0.0;
         this.downloads = 0;
         this.likes = 0;
         this.loadedImage = "https://via.placeholder.com/300.png/09f/fff%20C/O%20https://placeholder.com/";
      }
      render() {
         return y`
         <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0"
         />
         <div class="item-card">
            <div class="item-card-body">
               ${this.premium ? y` <div class="premium-tag">premium</div>` : ""}
               <div class="overlay">
                  <div id="buttons">
                     <button id="like-btn" class=${this.isLiked ? "active" : ""} @click=${this.handleLikeButton}>
                        ${this.isLiked ? pmst_icons.likeSolid : pmst_icons.likeOutline}
                     </button>
                     ${this.editPermission
                        ? y`<button id="edit-btn" @click=${this.handleEditButton}>${pmst_icons.edit}</button>`
                        : ""}
                  </div>
                  <a id="item-link" href="${this.link}"></a>
               </div>
               <img src=${this.loadedImage} alt=${this.title} />
            </div>
            <div class="item-card-footer">
               <div class="item-card-info-left">
                  <h6>${this.title}</h6>
                  <div class="item-card-info">
                     <div class="info rating">
                        <div class="icon" style="fill: #ed8a1a">${icons.star}</div>
                        <div class="value">${this.rating}</div>
                     </div>
                     <div class="info downloads">
                        <div class="icon" style="fill: #1E6DFB">${icons.download}</div>
                        <div class="value">${this.downloads}</div>
                     </div>
                     <div class="info likes">
                        <div class="icon" style="fill: #1E6DFB">${icons.like}</div>
                        <div class="value">${this.likes}</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      `;
      }
      handleLikeButton() {
         this.dispatchEvent(
            new CustomEvent("like", { detail: { isLiked: !this.isLiked }, bubbles: true, composed: true })
         );
         this.isLiked = !this.isLiked;
      }
      handleEditButton() {
         this.dispatchEvent(new CustomEvent("edit", { bubbles: true, composed: true }));
      }

      updated(changedProperties) {
         console.log("changed");
         if (changedProperties.has("image")) {
            this.loadedImage = "";
            this.loadedImage = "https://via.placeholder.com/200.png?text=%20";
            let image = new Image();
            image.src = this.image;
            image.onload = () => (this.loadedImage = image.src);
         }
      }
   }
   if (!customElements.get("pmst-item-card")) {
      customElements.define("pmst-item-card", pmstItemCard);
   }

   var mainStyle$1 = i`
   ${colors}
   #checkout-wraper {
      display: flex;
      flex-direction: row;
      gap: 32px;
   }
   #checkout-left {
      width: 50%;
   }
   #checkout-right {
      width: 50%;
   }
   .card {
      display: flex;
      flex-direction: column;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.16);
      border: solid 1px #282f390f;
      height: 100%;
   }
   .card-header {
      padding: 16px;
      border-bottom: solid 1px var(--color-netural-100);
   }
   table {
      width: 100%;
      border-collapse: collapse;
   }
   table thead {
      border-bottom: solid 1px var(--color-netural-100);
      color: var(--color-netural-600);
   }
   table thead th {
      padding: 16px;
      text-align: left;
   }
   table tbody tr {
      border-bottom: solid 1px var(--color-netural-100);
   }
   table tbody tr td {
      padding: 16px;
      text-align: left;
   }
   .row {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      padding: 16px;
   }
   #total {
      border-top: solid 1px var(--color-netural-100);
   }
   .paddle-checkout-container {
      display: flex;
   }
   .paddle-checkout-container iframe {
      width: 100% !important;
      position: relative !important;
   }
`;

   class Checkout extends s$3 {
      static get styles() {
         return [mainStyle$1, typo];
      }
      static get properties() {
         return {
            userIsLogin: { type: Boolean },
            userData: { type: Object },
            orderData: { type: Object },
            paddleReady: { type: Boolean },
         };
      }
      constructor() {
         super();
         this.orderData = {
            plan: "",
         };
      }
      render() {
         return y`
         <div id="checkout-wraper">
            <div id="checkout-left" class="card">
               <div class="card-header"><h3>Billing Details</h3></div>
               ${!this.userIsLogin ? this.renderLoginForm() : ""} ${this.userIsLogin ? this.loadPaddleCheckout() : ""}
            </div>
            <div id="checkout-right" class="card">
               <h3 class="card-header">Order Summary</h3>
               <div id="order-details">
                  <table>
                     <thead>
                        <tr>
                           <th><h5>Product</h5></th>
                           <th><h5>Price</h5></th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td><h4>${this.orderData.plan}</h4></td>
                           <td><h4>$${this.orderData.price}</h4></td>
                        </tr>
                     </tbody>
                  </table>
                  <div id="subtotal" class="row">
                     <div><h5>Subtotal</h5></div>
                     <div><h5>$${this.orderData.price}</h5></div>
                  </div>
                  <div id="Taxes" class="row">
                     <div><h5>Taxes</h5></div>
                     <div><h5>$${this.orderData.tax}</h5></div>
                  </div>
                  <div id="total" class="row">
                     <div><h4>Total</h4></div>
                     <div><h4>$${this.orderData.total || this.orderData.price}</h4></div>
                  </div>
               </div>
            </div>
         </div>
      `;
      }
      renderLoginForm() {
         return y` <div id="login-form-wrapper" class="card">login</div>`;
      }
      loadPaddleCheckout() {
         if (this.paddleReady) return;
         let checkoutContainer = document.createElement("div");
         checkoutContainer.classList.add("paddle-checkout-container");
         document.body.appendChild(checkoutContainer);
         let checkoutElement = this;
         Paddle.Setup({
            vendor: 102289,
            eventCallback: function (eventData) {
               checkoutElement.updateCheckoutData(eventData);
            },
         });
         Paddle.Checkout.open({
            method: "inline",
            product: 672410,
            frameTarget: "paddle-checkout-container",
            frameInitialHeight: 500,
            email: this.userData.email,
         });
         let chekoutwrapper = this.shadowRoot.querySelector("#checkout-left");
         chekoutwrapper.appendChild(checkoutContainer);
         let iframe = this.shadowRoot.querySelector("iframe");
         iframe.style = "";
         this.paddleReady = true;
      }
      updateCheckoutData(eventData) {
         console.log(eventData);
         let newOrderData = Object.assign({}, this.orderData);
         newOrderData.plan = eventData.eventData.product.name;
         newOrderData.price = eventData.eventData.checkout.prices.customer.total;
         newOrderData.tax = eventData.eventData.checkout.prices.customer.total_tax;
         newOrderData.total = eventData.eventData.checkout.prices.customer.total;
         this.orderData = newOrderData;
         console.log(this.orderData);
      }
   }
   if (!customElements.get("pmst-checkout")) {
      customElements.define("pmst-checkout", Checkout);
   }

   var mainStyles = i`
   ${colors}
   #header {
      background: linear-gradient(45deg, var(--color-primary-300), var(--color-primary-400));
      width: 100%;
      min-height: 150px;
      max-height: fit-content;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 32px 32px;
      box-sizing: border-box;
      margin-bottom: 40px;
      color: white;
      text-align: center;
      gap: 8px;
   }
   #header #headline,
   #header #subheadline {
      max-width: 800px;
   }
   #main {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-start;
      width: 100%;
      gap: 32px;
      padding: 0 32px;
      box-sizing: border-box;
   }
   pmst-filter {
      position: sticky;
      top: 140px;
   }
   #right-column {
      max-width: 100%;
      overflow: hidden;
   }
   #items {
      width: 100%;
      min-width: 200px;
      height: 100%;
      display: flex;
      flex-wrap: wrap;
      gap: 32px;
   }
   pmst-item-card {
      flex: 1 0 15%;
      min-width: 240px;
      height: auto;
   }
   .hidden-flex.loading {
      flex: 1 0 15%;
      min-width: 240px;
      height: 240px;
      background-color: #f5f5f5;
      animation-name: placeHolderShimmer;
      animation-duration: 1s;
      animation-fill-mode: forwards;
      animation-iteration-count: infinite;
      animation-timing-function: linear;
      background: linear-gradient(to right, #eeeeee 8%, #e2e2e2 18%, #eeeeee 33%);
      background-size: 800px 104px;
      border-radius: 8px;
      border: 3px solid #fff;
      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
   }
   .hidden-flex.hidden {
      flex: 1 0 15%;
      min-width: 240px;
      height: 0;
   }

   /* Pagination style */
   pmst-pagination {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      width: 100%;
      gap: 8px;
      margin-top: -32px;
      margin-bottom: 100px;
   }
   pmst-pagination.hidden {
      display: none;
   }
   #plus-banner {
      align-self: center;
      margin: 100px 32px;
      display: flex;
      flex-direction: column;
      justify-content: center;
   }
   #plus-banner plus-banner {
      --border-radius: 20px;
   }
   /* placeHolderShimmer animation */
   @keyframes placeHolderShimmer {
      0% {
         background-position: -468px 0;
      }
      100% {
         background-position: 468px 0;
      }
   }

   @media (max-width: 1024px) {
   }
   @media (max-width: 900px) {
      #main {
         position: relative;
         box-sizing: border-box;
         padding: 0 16px;
         gap: 16px;
      }
      #right-column {
         max-width: calc(100% - 50px);
      }
      #items {
         gap: 16px;
      }
      pmst-filter.open {
         position: fixed;
         top: 70px;
         left: 0;
         height: 100%;
         margin-left: 0px;
         background-color: #ffffffb3;
         z-index: 1;
         box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
         padding: 12px;
         backdrop-filter: blur(8px);
         -webkit-backdrop-filter: blur(8px);
         -moz-backdrop-filter: blur(8px);
      }
   }
   @media (max-width: 768px) {
   }
   @media (max-width: 600px) {
   }
   @media (max-width: 480px) {
   }
`;

   async function getItems(params = {}, auth = {}) {
      params = {
         orderby: params.orderby || "date",
         order: params.order || "DESC",
         category: params.category || 0,
         free: params.free || false,
         limit: params.limit || 10,
         page: params.page || 1,
         per_page: params.per_page || 10,
         search: params.search || "",
         tags: params.tags || "",
         software: params.software || "",
      };
      let url = "https://premast.com/wp-json/pmst/v1/products?";
      let queryParams = new URLSearchParams(params);
      let headers = new Headers();
      auth.token ? headers.append("Authorization", "Bearer " + auth.token) : "";
      auth.nonce ? headers.append("X-WP-Nonce", auth.nonce) : "";

      console.log("request items");
      const response = await fetch(url + queryParams, {
         method: "GET",
         headers: headers,
      });
      return await response.json();
   }

   async function likeItems(itemId, auth = {}) {
      let url = "https://premast.com/wp-json/pmst/v1/like";
      let headers = new Headers();
      headers.append("Content-Type", "application/json");
      auth.token ? headers.append("Authorization", "Bearer " + auth.token) : "";
      auth.nonce ? headers.append("X-WP-Nonce", auth.nonce) : "";

      const response = await fetch(url, {
         method: "POST",
         headers: headers,
         body: JSON.stringify({
            item_id: itemId,
         }),
      });
      console.log("item id", itemId);
      return await response.json();
   }

   var mainStyles$1 = i`
   ${colors}
   input[type="radio"] {
      appearance: none;
      width: 16px;
      height: 15px;
      border: 1px solid var(--color-netural-200);
      border-radius: 40px;
      outline: none;
      background-color: var(--color-netural-100);
      margin-top: 8px;
   }
   input[type="radio"]:checked {
      background-color: var(--color-primary-300);
      box-shadow: inset 0px 0px 0px 2px var(--color-primary-100);
   }
   #filter {
      min-height: calc(100vh - 160px);
      display: flex;
      flex-direction: column;
   }
   /* scroll styles */
   #filter div::-webkit-scrollbar {
      width: 3px;
      border-radius: 16px;
   }
   #filter div::-webkit-scrollbar-track {
      background: transparent;
   }
   #filter div::-webkit-scrollbar-thumb {
      background: var(--color-netural-100);
   }
   .row {
      display: flex;
      flex-direction: row;
      gap: 8px;
      align-items: center;
   }
   #filter-header {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      width: 100%;
      padding: 8px;
      border-radius: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      align-items: center;
   }
   #filter-header:hover {
      cursor: pointer;
      background-color: var(--color-netural-50);
   }
   #filter-header svg {
      fill: var(--color-netural-600);
   }

   #filter-header:hover svg {
      fill: var(--color-primary-300);
   }
   #filter-body {
      width: 280px;
      font-family: "Roboto", sans-serif;
      font-size: 14px;
      display: flex;
      flex-direction: column;
      gap: 16px;
      flex: 1 1 auto;
   }
   .header-text {
      font-size: 14px;
      font-weight: 500;
      margin-bottom: 16px;
   }
   #search-term {
      display: flex;
      flex-direction: row;
      gap: 8px;
      padding: 4px 0px;
      background-color: var(--color-netural-100);
      border-radius: 4px;
      max-width: max-content;
      font-size: 13px;
      cursor: pointer;
   }
   #search-term:hover {
      background-color: var(--color-netural-200);
   }
   #keyword {
      padding: 0px 8px;
   }
   #clear-search {
      color: red;
      border-left: 1px solid var(--color-netural-200);
      padding: 0px 8px;
   }
   .filter-card {
      border-radius: 8px;
      background-color: var(--color-netural-50);
      border: 1px solid var(--color-netural-100);
      padding: 16px;
      display: flex;
      flex-direction: column;
   }
   #category-card {
      flex: 1 1 170px;
      overflow-y: auto;
   }
   #tag-card {
      flex: 1 1 170px;
      overflow-y: auto;
   }
   .sort-checkbox,
   .category-checkbox {
      display: flex;
      flex-direction: row;
      border-top: 1px solid var(--color-netural-100);
      gap: 8px;
   }
   #parent-category {
      display: flex;
      flex-direction: row;
      gap: 8px;
      align-items: center;
      margin-bottom: 16px;
      font-weight: 500;
      cursor: pointer;
   }
   label {
      width: 100%;
      height: 100%;
      cursor: pointer !important;
      padding: 8px 0;
   }
   [type="radio"]:checked + label {
      color: var(--color-primary-300);
   }

   #tag-list {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      gap: 8px;
   }
   .tag-item {
      padding: 4px 8px;
      background-color: var(--color-netural-100);
      border-radius: 6px;
      font-size: 13px;
      display: flex;
      flex-direction: row;
      gap: 4px;
      cursor: pointer;
      transition: all 0.1s ease-in-out;
   }
   .tag-item span {
      color: var(--color-netural-400);
      font-size: 12px;
   }
   .tag-item:hover {
      background-color: var(--color-netural-200);
   }
   .tag-item.selected {
      color: var(--color-netural-700);
      background-color: var(--color-netural-200);
   }
   .tag-item.selected:hover {
      background-color: var(--color-netural-300);
   }
   .tag-item.selected span {
      color: var(--color-netural-600);
   }
`;

   async function getCategories(params = {}) {
      params = {
         parent_id: params.parentId || 0,
      };
      let url = "https://premast.com/wp-json/pmst/v1/categories?";
      let queryParams = new URLSearchParams(params);
      const response = await fetch(url + queryParams);
      return await response.json();
   }

   async function getTags(params = {}) {
      params = {};
      let url = "https://premast.com/wp-json/pmst/v1/tags?";
      let queryParams = new URLSearchParams(params);
      const response = await fetch(url + queryParams);
      return await response.json();
   }

   class PmstFilter extends s$3 {
      static get styles() {
         return [mainStyles$1, typo];
      }
      static get properties() {
         return {
            open: { type: Boolean },
            currentCategory: { type: String },
            currentCategoryName: { type: String },
            parentCategoryId: { type: String },
            parentCategoryLink: { type: String },
            parentCategory: { type: Object },
            childCategories: { type: Array },
            sort: { type: String },
            search: { type: String },
            tags: { type: Array },
            selectedTags: { type: Array },
            software: { type: Array },
            selectedSoftware: { type: String },
         };
      }
      constructor() {
         super();
         this.open = true;
         this.currentCategory = 884;
         // this.parnetCategoryId = 884;
         this.childCategories = [];
         this.parentCategory = {};
         this.tags = [];
         this.selectedTags = [];
         this.software = ["powerpoint", "google-slides"];
         this.selectedSoftware = "";
      }
      async firstUpdated() {
         await this.updateCategories();
         await this.updateTags();
      }
      render() {
         return y`
         <div id="filter">
            <div id="filter-header" @click=${this.handleOpen}>
               <div class="row">${pmst_icons.sort} ${this.open ? y`<h5>Filters</h5>` : ``}</div>
               ${this.open ? pmst_icons.arrow_left : ""}
            </div>
            ${this.open ? this.renderFilter() : ""}
         </div>
      `;
      }

      async updateCategories() {
         let url = new URL(window.location.href);
         let sort = url.searchParams.get("sort");
         let search = url.searchParams.get("refine");
         sort ? (this.sort = sort) : false;
         search ? (this.search = search) : false;

         // check parent category
         let childCategories = await getCategories({ parentId: this.parentCategoryId });
         this.childCategories = childCategories.categories;
         this.parentCategory = childCategories.parent_category;
      }

      async updateTags() {
         let tags = await getTags();
         this.tags = tags;
      }

      renderFilter() {
         return y`
         <div id="filter-body">
            ${this.search
               ? y`
                    <div id="search-term" @click=${this.handleClearSearch}>
                       <div id="keyword">Search term: '${this.search}'</div>
                       <div id="clear-search">x</div>
                    </div>
                 `
               : ""}
            <div id="sort-card" class="filter-card">
               <div class="header-text">Sort by</div>
               <div class="sort-checkbox">
                  <input
                     type="radio"
                     name="sort"
                     id="sort-new"
                     value="date"
                     .checked=${this.sort == "date"}
                     @change=${this.handleSort}
                  />
                  <label for="sort-new">New</label>
               </div>
               <div class="sort-checkbox">
                  <input
                     type="radio"
                     name="sort"
                     id="sort-popular"
                     value="popular"
                     .checked=${this.sort == "popular"}
                     @change=${this.handleSort}
                  />
                  <label for="sort-popular">Popular</label>
               </div>
            </div>

            <div id="category-card" class="filter-card">
               <div class="header-text">Category</div>
               <div id="parent-category" @click=${this.handleCategory}>${this.parentCategory.name}</div>
               ${this.childCategories.map((category) => {
                  if (!category.hide) {
                     return y` <div class="category-checkbox">
                        <input
                           type="radio"
                           name="category"
                           id="category-${category.cat_ID}"
                           value=${category.cat_ID}
                           .checked=${this.currentCategory == category.cat_ID ? true : false}
                           @change=${this.handleCategory}
                        />
                        <label for="category-${category.cat_ID}">${category.name}</label>
                     </div>`;
                  }
               })}
            </div>

            <div id="software-card" class="filter-card">
               <div class="header-text">Software</div>
               <div id="software-list">
                  ${this.software.map(
                     (software) =>
                        y` <div
                           class="software-item 
                           sort-checkbox
                           ${this.selectedSoftware == software ? "selected" : ""}"
                           @click=${(e) => this.handleSoftwareSelection(software)}
                        >
                           <input type="radio" name="software" id="software-${software}" value=${software} />
                           <label for="software-${software}">${software}</label>
                        </div>`
                  )}
               </div>
            </div>

            <div id="tag-card" class="filter-card">
               <div class="header-text">Tags</div>
               <div id="tag-list">
                  ${this.tags.map((tag) => {
                     return y`
                        <div
                           class="tag-item ${this.selectedTags.indexOf(tag.name) > -1 ? "selected" : ""}"
                           @click=${(e) => this.handleTagSelection(tag)}
                        >
                           ${tag.name}<span>${tag.count}</span>
                        </div>
                     `;
                  })}
               </div>
            </div>
         </div>
      `;
      }

      handleTagSelection(tag) {
         // toggle this tag in selected tag array
         // if tag is already selected, remove it from array
         // if tag is not selected, add it to array
         let tags = [...this.selectedTags];
         let index = tags.indexOf(tag.name);
         if (index > -1) {
            tags.splice(index, 1);
         } else {
            tags.push(tag.name);
         }
         this.selectedTags = tags;
         this.dispatchEvent(new CustomEvent("tag", { detail: this.selectedTags }, { bubbles: true, composed: true }));
      }

      handleClearSearch() {
         this.search = "";
         this.dispatchEvent(new CustomEvent("search", { detail: this.search }, { bubbles: true, composed: true }));
         // add parameter to current url
         let url = new URL(window.location.href);
         url.searchParams.delete("refine");
         window.history.pushState({}, "", url);
      }
      handleOpen() {
         this.open = !this.open;
         this.classList.toggle("open");
      }
      handleSort(e) {
         this.sort = e.target.value;
         this.dispatchEvent(new CustomEvent("sort", { detail: this.sort }, { bubbles: true, composed: true }));
         // add parameter to current url
         let url = new URL(window.location.href);
         url.searchParams.set("sort", this.sort);
         url.searchParams.set("refine", this.search);
         window.history.pushState({}, "", url);
      }
      handleCategory(e) {
         // get category from children array using id
         this.currentCategory = e.target.value;
         if (!e.target.value) {
            this.currentCategory = this.parentCategoryId;
            let url = new URL(this.parentCategoryLink);
            url.searchParams.set("sort", this.sort);
            url.searchParams.set("refine", this.search);
            try {
               window.history.pushState({}, "", url);
            } catch (e) {}
         } else {
            let category = this.childCategories.find((category) => category.cat_ID == this.currentCategory);
            this.currentCategoryName = category.name;
            let url = new URL(category.permalink);
            url.searchParams.set("sort", this.sort);
            url.searchParams.set("refine", this.search);
            try {
               window.history.pushState({}, "", url);
            } catch (e) {
               console.log(url);
            }
         }
         this.dispatchEvent(
            new CustomEvent("category", { detail: this.currentCategory }, { bubbles: true, composed: true })
         );
      }

      handleSoftwareSelection(software) {
         this.selectedSoftware = software;
         this.dispatchEvent(
            new CustomEvent("software", { detail: this.selectedSoftware }, { bubbles: true, composed: true })
         );
         // add parameter to current url
         let url = new URL(window.location.href);
         url.searchParams.set("software", this.selectedSoftware);
         url.searchParams.set("refine", this.search);
         window.history.pushState({}, "", url);
      }
   }

   if (!customElements.get("pmst-filter")) {
      customElements.define("pmst-filter", PmstFilter);
   }

   var mainStyle$2 = i`
   ${colors}
   #pagination {
      display: flex;
      flex-direction: row;
      justify-content: center;
   }

   #pagination button {
      background-color: transparent;
      border: none;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      padding: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
   }
   #pagination button svg {
      fill: var(--color-netural-600);
   }
   #pagination button[disabled] {
      opacity: 0.5;
   }
   #pagination button:hover {
      background-color: var(--color-netural-100);
   }

   #pagination ul {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      list-style: none;
      padding: 0;
      margin: 0;
      gap: 1rem;
   }
   #pagination ul li {
      list-style: none;
      height: 32px;
      width: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
   }

   #pagination .more {
      cursor: default;
   }

   #pagination .active {
      background-color: var(--color-primary-300);
      color: var(--color-netural-100);
      cursor: default;
   }

   #pagination li:not(.active):not(.more):hover {
      background-color: var(--color-netural-100);
      cursor: pointer;
   }
   #pagination .number {
   }
`;

   class pmstPagination extends s$3 {
      static get styles() {
         return [mainStyle$2, typo];
      }
      static get properties() {
         return {
            totalPages: { type: Number },
            currentPage: { type: Number },
         };
      }
      constructor() {
         super();
      }
      render() {
         return y`
         <div id="pagination">
            <button @click=${() => this.changePage(this.currentPage - 1)} ?disabled=${this.currentPage === 1}>
               ${pmst_icons.arrow_left}
            </button>
            <ul>
               ${this.renderPages}
            </ul>
            <button
               @click=${() => this.changePage(this.currentPage + 1)}
               ?disabled=${this.currentPage === this.totalPages}
            >
               ${pmst_icons.arrow_right}
            </button>
         </div>
      `;
      }

      get renderPages() {
         let pages = [];
         let maxPages = 5;
         let startPage = 1;
         let endPage = this.totalPages;
         let isMaxSized = this.totalPages > maxPages;

         if (isMaxSized) {
            if (this.currentPage <= 3) {
               endPage = 5;
            } else if (this.currentPage + 1 >= this.totalPages) {
               startPage = this.totalPages - 4;
            } else {
               startPage = this.currentPage - 2;
               endPage = this.currentPage + 2;
            }
         }

         for (let i = startPage; i <= endPage; i++) {
            pages.push(i);
         }

         if (isMaxSized && startPage > 1) {
            pages.unshift("...");
         }

         if (isMaxSized && endPage < this.totalPages) {
            pages.push("...");
         }

         return pages.map((page) => {
            return y`<li
            class="${page === this.currentPage ? "active" : ""} ${page === "..." ? "more" : "number"}"
            @click=${() => this.changePage(page)}
         >
            <h5>${page}</h5>
         </li>`;
         });
      }

      changePage(page) {
         if (page === "...") {
            return;
         }
         if (page === this.currentPage) return;
         this.currentPage = page;
         this.dispatchEvent(new CustomEvent("change-page", { detail: { page: page }, bubbles: true, composed: true }));
      }
   }
   if (!customElements.get("pmst-pagination")) {
      customElements.define("pmst-pagination", pmstPagination);
   }

   var mainStyle$3 = i`
   ${colors}

   #view_more {
      background-image: linear-gradient(134.71deg, #13bfae -0.5%, #26d6c4 100%);
      color: #000;
      border: none;
      padding: 6px 16px;
      text-align: center;
      text-decoration: none;
      border-radius: 50px;
      max-width: fit-content;
      margin-top: 10px;
      font-family: "Roboto", sans-serif;
   }
   a {
      text-decoration: none;
      color: inherit;
      height: 100%;
   }
   #slides-container {
      display: flex;
      flex-direction: row;
      gap: 16px;
      padding: 16px;
      background-color: var(--color-netural-100);
      border: 1px solid var(--color-netural-200);
      border-radius: 10px;
      margin: 16px 0px;
      align-items: center;
   }
   #heading {
      display: flex;
      flex-direction: column;
      align-items: left;
      gap: 8px;
   }
   #heading img {
      width: 120px;
   }
   #slides {
      display: flex;
      flex-direction: row;
      flex-wrap: nowrap;
      overflow-x: scroll;
      width: 100%;
      max-width: 100%;
      padding-bottom: 16px;
   }
   #slides::-webkit-scrollbar {
      height: 2px;
   }
   #slides::-webkit-scrollbar-track {
      background: var(--color-netural-100);
   }
   #slides::-webkit-scrollbar-thumb {
      background: var(--color-netural-300);
   }
   .slide {
      min-width: 200px;
      max-width: 200px;
      height: fit-content;
      background-color: var(--color-netural-50);
      border: 1px solid var(--color-netural-100);
      margin: 0 8px;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 8px;
      gap: 8px;
   }
   .slide h6 {
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
      max-width: 100%;
   }
   .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 8px;
      border: 1px solid var(--color-netural-100);
   }
   .active {
      transform: scale(1.01);
      transition: all 0.2s;
      cursor: grabbing;
      cursor: -moz-grabbing;
      cursor: -webkit-grabbing;
   }
   .drag {
      pointer-events: none;
   }
`;

   class plusSlidesSearch extends s$3 {
      static get styles() {
         return [mainStyle$3, typo];
      }

      static get properties() {
         return {
            slides: { type: Array },
            selectedSlide: { type: Object },
            drag: { type: Boolean },
            searchKeyword: { type: String },
         };
      }

      constructor() {
         super();
         this.slides = [];
         this.selectedSlide = {};
      }
      firstUpdated() {
         this.getSlides().then((res) => {
            console.log(res.response.items);
            this.slides = res.response.items;
         });
      }
      async getSlides() {
         let url = new URL("https://plus.premast.com/api/1.1/wf/search_items");
         const response = await fetch(url, {
            method: "POST",
            headers: {
               "Content-Type": "application/json",
            },
            body: JSON.stringify({
               category: "1609057126494x944628159621106800",
               keyword: this.searchKeyword,
               limit: 20,
               cursor: 0,
            }),
         });
         const data = await response.json();
         return data;
      }

      render() {
         return y` <div id="slides-container">
         <div id="heading">
            <h4>Results from</h4>
            <img src="https://dd7tel2830j4w.cloudfront.net/f1624633173347x601060463974310300/LOGO.svg" />
            <a href="https://plus.premast.com/items/templates?query=${this.searchKeyword}" target="blank" id="view_more"
               >View more</a
            >
         </div>
         <div
            id="slides"
            @mousedown=${(e) => {
               e.preventDefault();
               let el = e.currentTarget;
               el.isDown = true;
               el.startX = e.pageX - el.offsetLeft;
               el.scroll = el.scrollLeft;
            }}
            @mouseleave=${(e) => {
               let el = e.currentTarget;
               el.isDown = false;
               el.classList.remove("active");
            }}
            @mouseup=${(e) => {
               let el = e.currentTarget;
               el.isDown = false;
               el.classList.remove("active");
               this.drag = false;
            }}
            @mousemove=${(e) => {
               let el = e.currentTarget;
               if (!el.isDown) return;
               this.drag = true;
               el.classList.add("active");
               let scrollLeft = el.scroll;
               const x = e.pageX - el.offsetLeft;
               const walk = (x - el.startX) * 1.5;
               el.scrollLeft = scrollLeft - walk;
            }}
         >
            ${this.slides ? this.renderSlides() : ""}
         </div>
      </div>`;
      }

      renderSlides() {
         return this.slides.map((slide) => {
            return y`
            <a href="https://plus.premast.com/item/${slide.Slug}" target="blank" class="${this.drag ? "drag" : ""}">
               <div class="slide">
                  <img src="https:${slide["preview image"]}" />
                  <h6 class="slide-title">${slide.name}</h6>
               </div>
            </a>
         `;
         });
      }
   }

   if (!customElements.get("plus-slides-search")) {
      customElements.define("plus-slides-search", plusSlidesSearch);
   }

   class CustomDesignBanner extends s$3 {
      static get styles() {
         return i`
         ${typo}
         ${colors}
         :host {
            width: 100%;
            background-color: var(--color-netural-50);
            border: 1px solid var(--color-netural-100);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            padding: 16px;
            box-sizing: border-box;
            gap: 16px;
            height: auto;
            margin: 32px 0px;
         }
         .col {
            display: flex;
            flex-direction: column;
            gap: 16px;
         }
         #widget-wrapper {
            width: 100%;
            height: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 32px;
            align-items: center;
            justify-content: space-between;
         }
         #main-button {
            width: max-content;
            background-color: var(--color-netural-700);
            padding: 8px 16px;
            border-radius: 50px;
            outline: none;
            color: var(--color-netural-50);
            border: none;
            font-size: 18px;
            font-family: "Roboto";
            text-decoration: none;
         }
         #right img {
            max-height: 185px;
         }
      `;
      }
      render() {
         return y`
         <div id="widget-wrapper">
            <div id="left" class="col">
               <h2>Can't find what you need</h2>
               <p>Request a custom template design for just $5/slide</p>
               <a href="https://premast.com/request" target="blank" id="main-button">Get started Now $5/slide</a>
            </div>
            <div id="right" class="col">
               <img src="https://premast.com/files/website/templates/widgets/customdesign.svg" />
            </div>
         </div>
      `;
      }
   }
   if (!customElements.get("custom-design-banner")) {
      customElements.define("custom-design-banner", CustomDesignBanner);
   }

   class AllItems extends s$3 {
      static get styles() {
         return [mainStyles, typo];
      }

      static get properties() {
         return {
            items: { type: Array },
            parentCategoryId: { type: Number },
            parentCategoryLink: { type: String },
            params: { type: Object },
            nonce: { type: String },
            token: { type: String },
            totalPages: { type: Number },
            totalItems: { type: Number },
            loading: { type: Boolean },
            headline: { type: String },
            subHeadline: { type: String },
         };
      }

      constructor() {
         super();
         this.items = [];
         this.params = {
            category: 884,
            page: 1,
            per_page: 10,
         };
         window.addEventListener("popstate", (e) => {
            window.location.reload();
         });
         this.totalItems = "";
      }

      async loadItems(params) {
         this.items = [];
         this.loading = true;
         console.log("loading items...");
         let auth = {
            nonce: this.nonce,
            token: this.token,
         };
         let nParams = {
            orderby: params.orderby || this.params.orderby || "date",
            category: params.category || this.params.category || 884,
            page: params.page || 1,
            per_page: this.params.per_page || 10,
            search: params.search || this.params.search || "",
            tags: params.tags || this.params.tags || "",
            software: params.software || this.params.software || "",
         };
         console.log(nParams);
         let items = await getItems(nParams, auth);
         console.log(items);
         this.items = items.data;
         this.totalPages = items.total_pages;
         console.log(items);
         this.params = nParams;
         if (items.total === 0) {
            this.totalItems = 0;
         }
         this.totalItems = items.total;
         this.loading = false;
         // update SEO data based on results
         let title = ` Get ${this.totalItems} items from Premast templates`; //
         let metaDescription = `Get access to ${this.totalItems} items in ${
         this.params.category == 0 ? "all categories" : this.shadowRoot.querySelector("pmst-filter").currentCategoryName
      } on Premast Templates `;

         let metaDescriptionElement = document.querySelector('meta[name="description"]');
         if (!metaDescriptionElement) {
            metaDescriptionElement = document.createElement("meta");
            metaDescriptionElement.setAttribute("name", "description");
            document.head.appendChild(metaDescriptionElement);
         }
         metaDescriptionElement.setAttribute("content", metaDescription);
         document.title = title;
      }

      async firstUpdated() {
         // get default params from url in first page update
         let url = new URL(window.location.href);
         let sort = url.searchParams.get("sort");
         let params = {
            orderby: sort,
            category: this.params.category,
            tags: this.params.tags,
            page: this.params.page, //TODO : get page from url
            per_page: this.params.per_page,
         };
         this.loadItems(params);
         // reload window when go back
         window.addEventListener("popstate", (e) => {
            window.location.reload();
         });
      }

      updated(changedProperties) {
         let filter = this.shadowRoot.querySelector("pmst-filter");
         filter.parentCategoryId = this.parentCategoryId;
      }

      render() {
         return y`
         <div id="header">
            <h2 id="headline">${this.getHeader().headline}</h2>
            <h5 id="subheadline">${this.getHeader().subHeadline}</h5>
         </div>
         <div id="main">
            <pmst-filter 
            class='open'
            parentCategoryId=${this.parentCategoryId}
               parentCategoryLink=${this.parentCategoryLink}
               currentCategory=${this.params.category}
               search=${this.params.search}
               @search=${this.handleSearch}
               @sort=${this.handleSort}
               @category=${this.handleCategory}
               @tag=${this.handleTags}
               @software=${this.handleSoftware}
            ></pmst-filter>
            <div id = "right-column">
            <div id="items">
               ${
                  !this.loading && this.totalItems === 0
                     ? y`<div id="no-reult-container">
                          <div id="no-reult-image"></div>
                          <div id="no-result-text">
                             <h3>No items found</h3>
                             <p>We couldnt find any items based on your search, try again with different keywords</p>
                          </div>
                       </div>`
                     : ""
               }
               ${this.items.map((item) => {
                  return y`<pmst-item-card
                     title=${item.title}
                     link=${"https://premast.com/product/" + item.slug}
                     image=${item.image.large}
                     rating=${item.rating}
                     downloads=${item.downloads}
                     likes=${item.likes}
                     ?premium=${item.price > 0}
                     ?isLiked=${item.is_liked}
                     ?editPermission=${item.user_can_edit}
                     @edit=${(e) => window.location.assign(item.edit_link)}
                     @like=${(e) => {
                        likeItems(item.id, { nonce: this.nonce, token: this.token }).then((res) => {
                           console.log(res);
                        });
                     }}
                  ></pmst-item-card> `;
               })}
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
               <div class="hidden-flex ${!this.loading ? "hidden" : "loading"}"></div>
            </div>
            <pmst-pagination 
            totalPages=${this.totalPages} currentPage=${this.params.page} 
            @change-page=${this.changePage}
            class = ${this.totalPages > 1 ? "show" : "hidden"}></pmst-pagination>
            </pmst-pagination>
            <custom-design-banner></custom-design-banner>
            <plus-slides-search
            searchKeyword=${
               this.params.search
                  ? this.params.search
                  : this.shadowRoot.querySelector("pmst-filter")
                  ? this.shadowRoot.querySelector("pmst-filter").currentCategoryName
                  : ""
            }
            ></plus-slides-search>
            </div>
         </div>
         <div
         id="plus-banner">
            <plus-banner></plus-banner>
         </div>
      `;
      }

      getHeader() {
         let header = {
            headline: this.headline,
            subHeadline: this.subHeadline,
         };

         if (this.params.search) {
            let filter = this.shadowRoot.querySelector("pmst-filter") || {};
            header.headline = `Search Results for ' ${this.params.search} '`;
            header.subHeadline = `You found ${this.totalItems} items in
         ${this.params.category == 0 ? "all categories" : filter.currentCategoryName}`;
         }
         return header;
      }

      handleSoftware(e) {
         console.log(e.detail);
         this.loadItems({
            software: e.detail,
         });
      }

      handleTags(e) {
         // convert tags array to string
         let tags = e.detail.join(",");
         console.log(tags);
         this.loadItems({ tags: tags });
      }

      handleSearch(e) {
         this.params.search = e.target.search;
         this.loadItems({
            search: this.params.search,
         });
      }

      handleSort(e) {
         this.params.orderby = e.target.sort;
         this.loadItems({
            orderby: this.params.orderby,
         });
      }
      handleCategory(e) {
         this.loadItems({
            category: e.target.currentCategory,
         });
      }
      changePage(e) {
         this.items = [];
         this.loadItems({
            page: e.target.currentPage,
         });
         // scroll to top
         window.scrollTo(0, 0);
         this.updateUrlPage(e.target.currentPage);
      }
      updateUrlPage(page) {
         // replace url page number
         let curl = new URL(window.location.href);
         // get path segments
         let path = curl.pathname.split("/");
         // find page number index
         let index = path.indexOf("page");
         // check if page number exists
         if (index > -1) {
            // replace page number
            path[index + 1] = page;
         } else {
            // add page number
            path.push("page");
            path.push(page);
         }
         // join path segments
         let newPath = path.join("/");
         // set new path
         curl.pathname = newPath;
         // get new url
         let newUrl = curl.href;
         console.log(newUrl);
         window.history.pushState({ path: newUrl }, "", newUrl);
      }
   }

   if (!customElements.get("pmst-items")) {
      customElements.define("pmst-items", AllItems);
   }

   var mainStyle$4 = i`
   ${colors}
   ${inputStyle}
   #home-header {
      padding: 32px;
      margin-bottom: 100px;
   }
   #home-header-content {
      background-image: url("https://premast.com/files/website/templates/pattern.png?v=2"),
         linear-gradient(
            96.03deg,
            var(--color-primary-400) 0.11%,
            var(--color-primary-300) 44.81%,
            var(--color-primary-200) 78.02%,
            var(--color-secondary-50) 113.06%
         );
      border-radius: 30px;
      background-blend-mode: darken normal;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      padding: 32px;
      align-items: center;
   }
   #header-left {
      max-width: 50%;
   }
   #header-right {
      width: 100%;
      min-width: 280px;
      max-width: 530px;
   }
   #header-text {
      color: var(--color-netural-50);
      display: flex;
      flex-direction: column;
      gap: 8px;
   }
   #header-image {
      position: relative;
      display: flex;
      flex-direction: column;
      margin-bottom: -15%;
   }
   #header-image a {
      width: 100%;
   }
   #header-image img {
      width: 100%;
   }
   #header-template-image {
      max-width: 330px;
      min-width: 150px;
      border-radius: 20px;
      box-shadow: 0px 24px 34px rgba(0, 0, 0, 0.28);
      margin-top: -15%;
      margin-left: 35%;
      transition: all 0.2s;
      display: flex;
      overflow: hidden;
   }
   #header-template-image img {
      width: 100%;
   }
   #header-template-image:hover {
      transition: all 0.2s;
      transform: scale(1.05);
   }
   #header-graphics-image {
      max-width: 320px;
      min-width: 150px;
      border-radius: 20px;
      box-shadow: 0px 4px 14px rgba(0, 0, 0, 0.28);
      margin-bottom: -15%;
      margin-right: 35%;
      transition: all 0.2s;
      display: flex;
      overflow: hidden;
   }
   #header-graphics-image:hover {
      transition: all 0.2s;
      transform: scale(1.05);
      z-index: 1000;
   }

   #search-container {
      display: flex;
      flex-direction: row;
      align-items: center;
      padding: 4px 4px 4px 16px;
      gap: 10px;
      background-color: var(--color-netural-50);
      border-radius: 100px;
      max-width: 415px;
      height: 40px;
      margin-top: 32px;
   }
   #search-container input {
      width: 100%;
      border: none;
      background-color: transparent;
   }
   #search-container input::placeholder {
   }
   #search-container input:focus {
      outline: none;
   }
   #search-container button {
      background-color: var(--color-secondary-300);
      color: var(--color-netural-50);
      border: none;
      border-radius: 100px;
      padding: 10px;
      flex: 0 0 35px;
      height: 35px;
   }
   .heading {
      display: flex;
      flex-direction: column;
      gap: 4px;
      width: 100%;
   }
   .heading h2 {
      color: var(--color-primary-400);
   }
   .section {
      display: flex;
      flex-direction: column;
      gap: 32px;
      align-items: center;
      justify-content: space-between;
      padding: 100px 32px;
   }
   .section button {
      margin-top: 32px;
      max-width: fit-content;
   }

   #trending-items {
      display: flex;
      flex-direction: row;
      gap: 32px;
      overflow-x: scroll;
      overflow-y: hidden;
      width: 100%;
      transition: all 0.2s;
      cursor: grab;
      padding-bottom: 10px;
   }
   #trending-items::-webkit-scrollbar {
      height: 3px;
   }
   #trending-items::-webkit-scrollbar-track {
      background: var(--color-netural-50);
   }
   #trending-items::-webkit-scrollbar-thumb {
      background: transparent;
      border-radius: 10px;
      transition: all 0.2s;
   }
   #trending-items:hover::-webkit-scrollbar-thumb {
      background: var(--color-primary-300);
      transition: all 0.2s;
   }

   #trending-items.active {
      transform: scale(1.01);
      transition: all 0.2s;
      cursor: grabbing;
      cursor: -moz-grabbing;
      cursor: -webkit-grabbing;
   }
   .drag {
      pointer-events: none;
   }
   #trending-items pmst-item-card {
      flex: 1 1 200px;
      min-width: 23%;
   }
   #plus-banner {
      padding: 32px;
   }
   plus-banner {
      --border-radius: 20px;
   }

   /* 
   //SECTION user prefered items  
   */
   #user-preferences-items {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      gap: 32px;
   }
   #user-preferences-items pmst-item-card {
      flex: 1 1 21%;
      min-width: 200px;
   }
   /* 
   //// recent items section style
   */
   #recent {
      display: flex;
      flex-direction: column;
      gap: 32px;
      margin-top: 50px;
   }
   #recent-header {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      width: 100%;
   }
   #category-tabs {
      display: flex;
      flex-direction: row;
      gap: 16px;
   }
   #category-tabs .tab {
      padding: 6px 16px;
      border-radius: 100px;
      background-color: var(--color-netural-50);
      cursor: pointer;
   }
   #category-tabs .tab.active {
      background-color: var(--color-netural-200);
      color: var(--color-primary-400);
   }

   #recent-items {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      gap: 32px;
   }
   #recent-items pmst-item-card {
      flex: 1 1 21%;
      min-width: 200px;
   }
   /* 
   //SECTION blog section styles
   */
   #blog {
      align-items: center;
      align-content: space-between;
      background-color: var(--color-netural-50);
      padding-top: 100px;
      padding-bottom: 100px;
   }
   #blog .heading {
      align-items: center;
   }
   #blog-items {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      gap: 32px;
      align-items: center;
      justify-content: space-between;
   }
   pmst-article-card {
      flex: 1 1 30%;
   }

   @media (max-width: 768px) {
      #home-header {
         padding: 16px;
      }
      #home-header-content {
         flex-wrap: wrap;
      }
      #header-left {
         max-width: 100%;
      }
      #header-image {
         align-items: center;
         gap: 8px;
         margin-top: 16px;
      }
      #header-image a {
         margin: 0;
         max-width: 95%;
      }
      #trending-items pmst-item-card {
         min-width: 75%;
      }
      #trending-items {
         gap: 16px;
      }
      .section {
         padding: 50px 16px;
      }
   }
   @media (max-width: 375px) {
      #trending-items pmst-item-card {
         flex: 1 1 85%;
      }
   }
`;

   var mainStyle$5 = i`
   ${colors}
   .drag {
      pointer-events: none;
   }
   .active {
      transform: scale(1.03);
      transition: all 0.2s;
      cursor: grabbing;
      cursor: -moz-grabbing;
      cursor: -webkit-grabbing;
   }
   #cat-list ul {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
      overflow-x: auto;
      padding: 10px 0px;
      padding-top: 8px 20px;
      transition: all 0.2s;
   }
   #cat-list ul::-webkit-scrollbar {
      height: 2px;
      background-color: transparent;
   }
   #cat-list ul::-webkit-scrollbar-thumb {
      background-color: var(--color-netural-50);
      border-radius: 10px;
   }

   #cat-list ul li {
      list-style: none;
      margin: 0 10px;
   }
   #cat-list ul li a {
      text-decoration: none;
      color: #000;
      height: 100%;
   }
   .cat-card {
      display: flex;
      flex-direction: row;
      background: var(--color-netural-50);
      border-radius: 20px;
      border: 1px solid var(--color-netural-200);
      min-width: 230px;
      height: 100%;
      min-height: 92px;
      box-sizing: border-box;
      align-items: center;
      padding: 8px 20px;
      transition: all 0.5s ease-in-out;
   }
   .cat-card:hover {
      background: linear-gradient(45deg, var(--color-primary-200) 0%, var(--color-primary-300) 100%);
      transition: all 0.3s ease-in-out;
      transform: scale(1.03) translateY(-5px);
      color: var(--color-netural-50);
   }
   .cat-card:hover .cat-card-image {
      filter: brightness(3);
      -webkit-filter: brightness(3);
      -moz-filter: brightness(3);
      transition: all 0.5s linear;
   }
   .cat-card-image {
   }
   #count {
      color: var(--color-netural-500);
   }
`;

   class pmstCatList extends s$3 {
      static get styles() {
         return [mainStyle$5, typo];
      }

      static get properties() {
         return {
            categories: { type: Array },
            drag: { type: Boolean },
         };
      }

      constructor() {
         super();
         this.categories = [];
      }

      firstUpdated() {
         getCategories({
            parentId: 884,
         })
            .then((res) => {
               this.categories = res.categories;
               console.log("categories", this.categories);
            })
            .catch((err) => {});
      }

      render() {
         return y`
         <div id="cat-list">
            <ul
               @mousedown=${(e) => {
                  e.preventDefault();
                  let el = e.currentTarget;
                  el.isDown = true;
                  el.startX = e.pageX - el.offsetLeft;
                  el.scroll = el.scrollLeft;
               }}
               @mouseleave=${(e) => {
                  let el = e.currentTarget;
                  el.isDown = false;
                  el.classList.remove("active");
               }}
               @mouseup=${(e) => {
                  let el = e.currentTarget;
                  el.isDown = false;
                  el.classList.remove("active");
                  this.drag = false;
               }}
               @mousemove=${(e) => {
                  let el = e.currentTarget;
                  if (!el.isDown) return;
                  this.drag = true;
                  el.classList.add("active");
                  let scrollLeft = el.scroll;
                  const x = e.pageX - el.offsetLeft;
                  const walk = (x - el.startX) * 2;
                  el.scrollLeft = scrollLeft - walk;
               }}
            >
               ${this.categories.map(
                  (cat) => y`
                     <li class="${this.drag ? "drag" : ""}">
                        <a href="${cat.permalink}">
                           <div class="cat-card">
                              <div class="cat-card-image">
                                 <img src="${cat.icon}" alt="" />
                              </div>
                              <div id="cat-card-data">
                                 <h4>${cat.name}</h4>
                                 <p id="count">${cat.count} items</p>
                              </div>
                           </div>
                        </a>
                     </li>
                  `
               )}
            </ul>
         </div>
      `;
      }
   }
   if (!customElements.get("pmst-cat-list")) {
      customElements.define("pmst-cat-list", pmstCatList);
   }

   async function getTrendingItems(params = {}, auth = {}) {
      params = {
         limit: params.limit || 10,
      };
      let url = "https://premast.com/wp-json/pmst/v1/top-downloads?";
      let queryParams = new URLSearchParams(params);
      let headers = new Headers();
      auth.token ? headers.append("Authorization", "Bearer " + auth.token) : "";
      auth.nonce ? headers.append("X-WP-Nonce", auth.nonce) : "";
      const response = await fetch(url + queryParams, {
         method: "GET",
         headers: headers,
      });
      return await response.json();
   }

   var mainStyle$6 = i`
   ${colors}

   #article-card {
      display: flex;
      flex-direction: column;
      align-items: left;
      box-sizing: border-box;
      padding: 16px;
      gap: 13px;
      background: #fff;
      border: 1px solid var(--color-netural-100);
      border-radius: 20px;
      flex-grow: 1;
      max-width: 430px;
      min-width: 150px;
   }
   #article-card:hover {
      background: var(--color-netural-100);
      transition: all 0.3s ease-in-out;
   }

   a {
      text-decoration: none;
      color: unset;
   }
   #article-card-image {
      width: 100%;
      height: 100%;
      max-height: 200px;
      transition: all 0.3s ease-in-out;
   }
   #article-card-image img {
      width: 100%;
      max-height: 200px;
      min-height: 170px;
      height: 100%;
      object-fit: cover;
      border-radius: 10px;
      filter: drop-shadow(0px 1px 2px rgba(30, 27, 53, 0.2));
      transition: all 0.3s ease-in-out;
   }
   #article-card:hover img {
      filter: drop-shadow(0px 4px 6px rgba(30, 27, 53, 0.15));
      transition: all 0.3s ease-in-out;
      transform: scale(1.02);
   }
   #article-card:hover #article-card-image {
      transition: all 0.3s ease-in-out;
      transform: scale(1.02);
   }
   #article-card-content {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 12px 6px;
      gap: 8px;
      max-height: 200px;
   }
   #article-card-content h5 {
      font-weight: 500;
   }
   #article-card-content h6 {
      color: var(--color-netural-600);
      max-height: 120px;
      text-overflow: ellipsis;
      overflow: hidden;
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      white-space: normal;
   }
   #article-card span {
      color: var(--color-primary-300);
      font-size: 14px;
      font-weight: 500;
   }
`;

   class pmstArticleCard extends s$3 {
      static get styles() {
         return [mainStyle$6, typo];
      }

      static get properties() {
         return {
            title: { type: String },
            description: { type: String },
            image: { type: String },
            link: { type: String },
         };
      }

      constructor() {
         super();
         this.title = "";
         this.description = "";
         this.image = "";
         this.link = "";
      }

      render() {
         return y`
         <a href="${this.link}" target="_blank">
            <div id="article-card">
               <div id="article-card-image">
                  <img src="${this.image}" alt="" />
               </div>
               <div id="article-card-content">
                  <h5>${this.title}</h5>
                  <h6>${this.description}</h6>
               </div>
               <span>Read more</span>
            </div>
         </a>
      `;
      }
   }
   if (!customElements.get("pmst-article-card")) {
      customElements.define("pmst-article-card", pmstArticleCard);
   }

   async function getArticles(params = {}) {
      params = {
         parent_id: params.parentId || 0,
         page: params.page || 1,
         per_page: params.per_page || 10,
         orderby: params.orderby || "date",
      };
      let url = "https://premast.com/wp-json/pmst/v1/blog/articles?";
      let queryParams = new URLSearchParams(params);
      const response = await fetch(url + queryParams);
      return await response.json();
   }

   var mainStyle$7 = i`
   :host {
      --border-radius: 0px;
   }
   h2,
   h5 {
      color: white;
   }
   .button {
      background-image: linear-gradient(134.71deg, #13bfae -0.5%, #26d6c4 100%);
      color: #000;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      border-radius: 50px;
      max-width: fit-content;
      font-family: "Roboto", sans-serif;
   }
   #plus-banner {
      background-image: url("https://premast.com/files/website/templates/plus-battern.png"),
         linear-gradient(93.02deg, #121842 -4.62%, #0f2443 98.39%);
      background-blend-mode: normal, normal;
      background-size: cover;

      padding: 16px;
      display: flex;
      justify-content: center;
      border-radius: var(--border-radius);
   }
   #plus-banner-container {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      width: 100%;
   }

   #plugin-widget {
      width: 50%;
      max-width: 500px;
      min-width: 350px;
      margin: 16px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0px 6px 20px #0000003d;
      margin-bottom: -50px;
   }
   #ppt-header {
      width: 100%;
      background-color: #d21a00;
      height: 100%;
   }
   #plugin-widget img {
      width: 100%;
   }
   #plugin-widget-body {
      width: 100%;
      min-height: 200px;
      background-color: #ececec;
      display: flex;
      flex-direction: row;
      max-height: 300px;
   }
   #slide-preview {
      width: 100%;
      padding: 16px;
      display: flex;
      justify-content: center;
   }
   #slide-preview img {
      align-self: center;
      max-height: 100%;
      max-width: fit-content;
   }

   #plugin {
      width: 180px;
      background-color: #fff;
      display: flex;
      flex-direction: column;
   }
   #plugin::-webkit-scrollbar {
      width: 1px;
   }
   #plugin-header {
      background-color: #ececec;
      padding: 4px 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;
   }

   #plugin-header #logo {
      max-width: 50%;
   }

   #plugin-body {
      display: flex;
      flex-direction: row;
      overflow-y: scroll;
   }
   #plugin-body::-webkit-scrollbar {
      width: 1px;
   }

   #slides {
      display: flex;
      flex-direction: column;
      gap: 8px;
      padding: 8px;
      height: fit-content;
   }
   .slide {
      display: flex;
      width: 100%;
      height: 100%;
      border-radius: 4px;
      overflow: hidden;
      border: 1px solid #ececec;
      cursor: pointer;
   }
   .slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
   }
   .slide:hover img {
      transform: scale(1.1);
      transition: transform 0.5s;
      filter: brightness(0.8);
   }

   #side-bar {
      min-width: 20px;
      height: 100%;
      background-color: #f9f9f9;
      position: sticky;
      top: 0;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      align-items: center;
      gap: 8px;
      padding-top: 8px;
   }
   .side-bar-item {
      flex: 0 0 10px;
      width: 10px;
      min-height: 10px;
      background-color: black;
      background-color: #cdd1d7;
      border-radius: 2px;
   }

   #plus-banner-content {
      display: flex;
      flex-direction: column;
      gap: 16px;
      max-width: 540px;
      flex: 1 1 300px;
   }
   #plus-logo-light {
      max-width: 200px;
   }

   @media (max-width: 768px) {
      #plugin-widget {
         margin: 16px;
         flex: 1 1 100%;
         max-width: 100%;
         order: 1;
      }
      #plus-banner-content {
         flex: 1 1 100%;
         align-items: center;
         max-width: 100%;
      }
      h5 {
         text-align: center;
      }
   }
   @media (max-width: 400px) {
      #plugin-widget {
         margin: 16px;
         min-width: 100px;
         max-height: 230px;
      }
      #plus-logo-light {
         max-width: 160px;
      }
      h2 {
         text-align: center;
         font-size: 23px;
      }
      h5 {
         text-align: center;
         font-size: 14px;
      }
   }
`;

   class PlusBanner extends s$3 {
      static get styles() {
         return [mainStyle$7, typo];
      }

      static get properties() {
         return {
            slides: { type: Array },
            selectedSlide: { type: Object },
         };
      }

      constructor() {
         super();
         this.slides = [];
         this.selectedSlide = {};
      }

      firstUpdated() {
         this.getSlides().then((res) => {
            this.slides = res.response.results;
            this.selectedSlide = this.slides[0];
         });
      }
      async getSlides() {
         // url query
         let query = new URLSearchParams({
            limit: 20,
            sort_field: "Created Date",
            descending: true,
            constraints: JSON.stringify([
               {
                  key: "category",
                  constraint_type: "contains",
                  value: "1609057126494x944628159621106800",
               },
            ]),
         });
         let url = new URL("https://plus.premast.com/api/1.1/obj/items");
         url.search = query;
         console.log(url);
         const response = await fetch(url);
         const data = await response.json();
         return data;
      }

      render() {
         return y`
         <div id="plus-banner">
            <div id="plus-banner-container">
               <div id="plugin-widget">
                  <div id="ppt-header">
                     <img src="https://premast.com/files/website/templates/ppt-header.svg" alt="plus-banner" />
                  </div>
                  <div id="plugin-widget-body">
                     <div id="slide-preview">
                        <img src="${this.selectedSlide["preview image"]}" alt="slide-preview" />
                     </div>
                     <div id="plugin">
                        <div id="plugin-header">
                           <img
                              id="logo"
                              src="https://dd7tel2830j4w.cloudfront.net/f1624633173347x601060463974310300/LOGO.svg"
                              alt="plugin-header"
                           />
                        </div>
                        <div id="plugin-body">
                           <div id="side-bar">
                              <span class="side-bar-item"></span>
                              <span class="side-bar-item"></span>
                              <span class="side-bar-item"></span>
                              <span class="side-bar-item"></span>
                           </div>
                           <div id="slides">
                              ${this.slides.map((slide) => {
                                 return y`
                                    <div class="slide" @click="${() => (this.selectedSlide = slide)}">
                                       <img src="${slide["preview image"]}" alt="slide" />
                                    </div>
                                 `;
                              })}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div id="plus-banner-content">
                  <img
                     id="plus-logo-light"
                     src="https://s3.amazonaws.com/appforest_uf/f1665583156945x204037027900566340/plus.svg"
                     alt="logo"
                  />
                  <h2>Create with absolute ease!</h2>
                  <h5>
                     Get access to tons of slide templates, icons, graphics and images inside Powerpoint & Googleslides
                  </h5>
                  <a class="button" href="https://plus.premast.com" target="blank">Start for free</a>
               </div>
            </div>
         </div>
      `;
      }
   }

   if (typeof window !== "undefined") {
      window.customElements.define("plus-banner", PlusBanner);
   }

   function getUserPreferences(auth = {}) {
      let url = "https://premast.com/wp-json/pmst/v1/users/user-preferences";
      let headers = new Headers();
      headers.append("Content-Type", "application/json");
      auth.token ? headers.append("Authorization", "Bearer " + auth.token) : "";
      auth.nonce ? headers.append("X-WP-Nonce", auth.nonce) : "";
      return fetch(url, {
         method: "GET",
         headers: headers,
      }).then((response) => response.json());
   }

   class pmstHome extends s$3 {
      static get styles() {
         return [mainStyle$4, typo, buttons];
      }

      static get properties() {
         return {
            headerTemplate: { type: Object },
            headerGraphics: { type: Object },
            articles: { type: Object },
            userPreferences: { type: Object },
            trending: { type: Array },
            recent: { type: Array },
            recentTemplates: { type: Array },
            recentGraphics: { type: Array },
            recentFree: { type: Array },
            recentFree: { type: Array },
            mainCategories: { type: Array },
            selectedCategory: { type: String },
            recentTabs: { type: Array },
            nonce: { typo: String },
            token: { type: String },
            drag: { type: Boolean },
         };
      }

      constructor() {
         super();
         this.headerTemplate = {
            image: {},
         };
         this.headerGraphics = {
            image: {},
         };
         this.recentTabs = [
            {
               name: "presentation",
               id: 884,
               active: true,
               value: "recentTemplates",
               link: "https://premast.com/product-category/presentation/?sort=date",
               describtion: "Stay updated, newely added presentation templates",
            },
            {
               name: "graphics",
               id: 3672,
               active: false,
               value: "recentGraphics",
               link: "https://premast.com/product-category/graphics/?sort=date",
               describtion: "Stay updated, newely added graphics",
            },
            {
               name: "free",
               active: false,
               value: "recentFree",
               link: "https://premast.com/free/",
               describtion: "Weekly free updates, hurry up before going premium!",
            },
         ];
      }
      firstUpdated() {
         //SECTION - get current user preferences items
         getUserPreferences({ nonce: this.nonce, token: this.token }).then((res) => {
            console.log(res);
            this.userPreferences = res;
         });

         //SECTION - get hero latest items (template & graphics)
         getItems(
            {
               orderby: "date",
               order: "DESC",
               category: 884,
               per_page: 1,
            },
            {
               nonce: this.nonce,
               token: this.token,
            }
         ).then((res) => {
            this.headerTemplate = res.data[0];
         });

         getItems({
            orderby: "date",
            order: "DESC",
            category: 3672,
            per_page: 1,
         }).then((res) => {
            this.headerGraphics = res.data[0];
         });

         //SECTION - Get recent item
         getItems(
            { porderby: "date", order: "DESC", category: 884, per_page: 12 },
            { nonce: this.nonce, token: this.token }
         )
            .then((res) => {
               this.recent = res.data;
               this.recentTemplates = res.data;
            })
            .catch((err) => {});

         getItems(
            { orderby: "date", order: "DESC", category: 3672, per_page: 12 },
            { nonce: this.nonce, token: this.token }
         )
            .then((res) => {
               this.recentGraphics = res.data;
            })
            .catch((err) => {});

         getItems(
            { orderby: "date", order: "DESC", free: true, per_page: 12 },
            { nonce: this.nonce, token: this.token }
         ).then((res) => {
            this.recentFree = res.data;
         });

         //SECTION - get trending items

         getTrendingItems({ limit: 12 }, { nonce: this.nonce, token: this.token })
            .then((res) => {
               this.trending = res;
            })
            .catch((err) => {});

         getArticles({ page: 1, per_page: 3 })
            .then((res) => {
               this.articles = res;
            })
            .catch((err) => {});
      }

      render() {
         return y`
         <div id="home">
            <div id="home-header">
               <div id="home-header-content">
                  <div id="header-left">
                     <div id="header-text">
                        <h1>Outstanding Templates & assets for your next presentation</h1>
                        <h4>to empower your business and deliver your ideas.</h4>
                        <form id="search-container" @submit=${this.search}>
                           <input type="text" placeholder="Search for templates" />
                           <button type="submit">${pmst_icons.searchIcon}</button>
                        </form>
                     </div>
                  </div>
                  <div id="header-right">
                     <div id="header-image">
                        <a href=${"https://premast.com/product/" + this.headerGraphics.slug} id="header-graphics-image">
                           <img src=${this.headerGraphics.image.large} />
                        </a>
                        <a href=${"https://premast.com/product/" + this.headerTemplate.slug} id="header-template-image">
                           <img src=${this.headerTemplate.image.large} />
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <pmst-cat-list></pmst-cat-list>
            <!-- Trending Items -->
            <div id="trending" class="section">
               <div class="heading">
                  <h2>Trending templates</h2>
                  <h5>Our most popular and most downloaded items for the past 30 days.</h5>
               </div>
               <div
                  id="trending-items"
                  @mousedown=${(e) => {
                     e.preventDefault();
                     let el = e.currentTarget;
                     el.isDown = true;
                     el.startX = e.pageX - el.offsetLeft;
                     el.scroll = el.scrollLeft;
                  }}
                  @mouseleave=${(e) => {
                     let el = e.currentTarget;
                     el.isDown = false;
                     el.classList.remove("active");
                  }}
                  @mouseup=${(e) => {
                     let el = e.currentTarget;
                     el.isDown = false;
                     el.classList.remove("active");
                     this.drag = false;
                  }}
                  @mousemove=${(e) => {
                     let el = e.currentTarget;
                     if (!el.isDown) return;
                     this.drag = true;
                     el.classList.add("active");
                     let scrollLeft = el.scroll;
                     const x = e.pageX - el.offsetLeft;
                     const walk = (x - el.startX) * 1.5;
                     el.scrollLeft = scrollLeft - walk;
                  }}
               >
                  ${this.trending ? this.renderTrendingItems() : ""}
               </div>
            </div>
            <div id="plus-banner">
               <plus-banner></plus-banner>
            </div>
            <!-- //SECTION user prefernces items  -->
            ${this.userPreferences ? this.renderUserPreferences() : ""}
               <!-- //SECTION Recent items -->
               <div id="recent" class="section">
                  <div id="recent-header">
                     <div class="heading">
                        <h2>Recent templates</h2>
                        <h5>${
                           // get active tab
                           this.recentTabs.find((tab) => tab.active).describtion
                        }</h5>
                     </div>
                     <div id="category-tabs">

                     
                        ${this.recentTabs.map(
                           (tab) =>
                              y`
                                 <div
                                    class="tab ${tab.active ? "active" : ""}"
                                    @click="${(e) => {
                                       // this.selectedCategory = tab.id;
                                       this.recentTabs.forEach((tab) => {
                                          tab.active = false;
                                       });
                                       tab.active = true;
                                       this.recent = this[`${tab.value}`];
                                    }}"
                                 >
                                    <h5>${tab.name}</h5>
                                 </div>
                              `
                        )}
                     </div>
                  </div>
                  <div id="category-tabs"></div>
                  <div id="recent-items">${this.recent ? this.renderRecentItems() : ""}</div>
                  <button class="btn-primary-normal"
                  @click = ${(e) => {
                     // find active tab
                     let activeTab = this.recentTabs.find((tab) => tab.active);
                     // get active tab link
                     let link = activeTab.link;
                     // redirect to link
                     window.location.href = link;
                  }}
                  >Load more</button>
               </div>
               <!-- Blog section -->
               <div id="blog" class="section">
                  <div class="heading">
                     <h2>Blog and News</h2>
                     <h5>Monthly updated blog articles</h5>
                  </div>
                  <div id="blog-items">${this.articles ? this.renderArticles() : ""}</div>
               </div>
            </div>
         </div>
      `;
      }

      renderTrendingItems() {
         console.log("trending items", this.trending);
         return y`
         ${this.trending.map(
            (item) => y`
               <pmst-item-card
                  image=${item.product.featured_image}
                  title=${item.product.name}
                  link=${"https://premast.com/product/" + item.product.slug}
                  downloads=${item.count}
                  rating=${item.product.avg_rating}
                  likes=${item.product.likes}
                  .premium=${item.product.price > 0}
                  .isLiked=${item.product.is_liked}
                  @like=${(e) => {
                     likeItems(item.product.id, { nonce: this.nonce, token: this.token }).then((res) => {
                        console.log(res);
                     });
                  }}
                  class="${this.drag ? "drag" : ""}"
               ></pmst-item-card>
            `
         )}
      `;
      }

      renderUserPreferences() {
         // check if this.preferences is array
         if (!Array.isArray(this.userPreferences)) return;
         return y`
         <div id="user-preferences" class="section">
            <div class="heading">
               <h2>Recommended for you</h2>
               <h5>Based on your preferences, we have selected these templates for you.</h5>
            </div>
            <div id="user-preferences-items">
               ${this.userPreferences.map(
                  (item) => y`
                     <pmst-item-card
                        image=${item.image.large}
                        title=${item.title}
                        link=${"https://premast.com/product/" + item.slug}
                        downloads=${item.downloads}
                        rating=${item.rating}
                        likes=${item.likes}
                        .premium=${item.price > 0}
                        .isLiked=${item.is_liked}
                        @like=${(e) => {
                           likeItems(item.id, { nonce: this.nonce, token: this.token }).then((res) => {
                              console.log(res);
                           });
                        }}
                     ></pmst-item-card>
                  `
               )}
            </div>
         </div>
      `;
      }

      renderRecentItems() {
         console.log(this.recent);
         return y`
         ${this.recent.map(
            (item) => y`
               <pmst-item-card
                  image=${item.image.large}
                  title=${item.title}
                  link=${"https://premast.com/product/" + item.slug}
                  downloads=${item.downloads}
                  rating=${item.rating}
                  likes=${item.likes}
                  .premium=${item.price > 0}
                  .isLiked=${item.is_liked}
                  @like=${(e) => {
                     likeItems(item.id, { nonce: this.nonce, token: this.token }).then((res) => {});
                  }}
               ></pmst-item-card>
            `
         )}
      `;
      }
      renderArticles() {
         console.log(this.articles);
         return y`
         ${this.articles.map(
            (article) => y`
               <pmst-article-card
                  title=${article.title}
                  description=${article.content}
                  image=${article.thumbnail}
                  link=${article.link}
               ></pmst-article-card>
            `
         )}
      `;
      }

      search(e) {
         console.log("searching");
         e.preventDefault();
         const search = e.target.querySelector("input").value;
         console.log(search);
         // go to search page
         window.location.href = `https://premast.com/templates/search?refine=${search}`;
      }

      switchRecentTab(id) {
         this.selectedCategory = id;
         this.recent = [];
         getItems(
            {
               orderby: "date",
               order: "DESC",
               category: id,
               per_page: 12,
            },
            {
               nonce: this.nonce,
               token: this.token,
            }
         ).then((res) => {
            this.recent = res.data;
         });
      }
      getRecentTemplates() {
         console.log("///get recent templates function");
         getItems(
            {
               orderby: "date",
               order: "DESC",
               per_page: 12,
               category: 884,
            },
            {
               nonce: this.nonce,
               token: this.token,
            }
         ).then((res) => {
            console.log(res);
            return res;
         });
      }

      getRecentGraphics() {}
   }

   if (typeof window.pmstHome === "undefined") {
      window.customElements.define("pmst-home", pmstHome);
   }

   var pricingTableCss = i`
   ${colors}
   ${buttons}
   ${typo}

   /* //SECTION switch toggle */
   #plans-switch {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
      margin-bottom: 2rem;
      gap: 16px;
   }
   #switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 28px;
   }
   #switch input {
      opacity: 0;
      width: 0;
      height: 0;
   }
   .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: var(--color-netural-400);
      -webkit-transition: 0.4s;
      transition: 0.4s;
      border-radius: 34px;
   }
   .slider:before {
      position: absolute;
      content: "";
      height: 20px;
      width: 20px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: 0.4s;
      transition: 0.4s;
      border-radius: 50%;
      box-shadow: 0px 3px 3px rgba(0, 0, 0, 0.3);
      background-color: var(--color-netural-50);
   }
   input:checked + .slider {
      background-color: var(--color-primary-300);
   }
   input:focus + .slider {
      box-shadow: 0 0 1px var(--color-primary-300);
   }
   input:checked + .slider:before {
      -webkit-transform: translateX(22px);
      -ms-transform: translateX(22px);
      transform: translateX(22px);
   }
   .label.active {
      color: var(--color-primary-300);
   }

   /* //SECTION plans table */
   #plans-table {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 16px;
   }
   .plan {
      display: flex;
      flex: 1 auto;
      gap: 16px;
      flex-direction: column;
      justify-content: center;
      background-color: var(--color-netural-50);
      border-radius: 16px;
      max-width: 350px;
      padding: 32px;
      box-sizing: border-box;
   }
   .plan h4 {
      color: var(--color-netural-600);
   }
   #basic h2 {
      color: var(--color-primary-300);
   }
   #advanced h2 {
      color: #14cc9f;
   }
   #price {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: left;
      gap: 8px;
      max-width: 100%;
   }

   #old-price {
      text-decoration: line-through;
      color: var(--color-netural-400);
   }
   ul {
      list-style: none;
      padding: 0;
      margin: 0;
   }
   li {
      list-style: none;
      color: var(--color-netural-700);
      display: flex;
      flex-direction: row;
      justify-content: left;
      align-items: center;
      gap: 8px;
   }
   li svg {
      fill: var(--color-primary-300);
      height: 24px;
   }

   .btn-primary-normal {
      border-radius: 24px;
      align-items: center;
      text-align: center;
      font-family: "Roboto";
      font-style: normal;
      text-decoration: none;
   }
`;

   class pmstPricingTable extends s$3 {
      static get styles() {
         return [pricingTableCss];
      }

      static get properties() {
         return {
            durations: { type: Array },
            selectedDuration: { type: String },
            plans: { type: Array, reflect: true, converter: { fromAttribute: (value) => JSON.parse(value) } },
         };
      }
      constructor() {
         super();
         this.durations = ["Monthly", "Yearly"];
         this.selectedDuration = this.durations[0];
         this.plans = [
            {
               id: 1,
               name: "Basic",
               subtitle: "Perfect to get started",
               price: {
                  monthly: 0,
                  yearly: 0,
               },
               description: "For anyone who is presenting in the upcoming few weeks or months…",
               features: ["1 User", "1 Project", "1GB Storage", "Basic Support", "Basic Features"],
               url: {
                  monthly: "https://premast.com/checkout/?add-to-cart=1088950",
                  yearly: "https://premast.com/checkout/?add-to-cart=1088983",
               },
            },
            {
               id: 2,
               name: "Advanced",
               subtitle: "Perfect to get started",
               price: {
                  monthly: 9.99,
                  yearly: 99.99,
               },
               salePrice: {
                  monthly: 7.99,
                  yearly: 79.99,
               },
               description: "For anyone who is presenting in the upcoming few weeks or months…",
               features: ["5 Users", "5 Projects", "10GB Storage", "Priority Support", "Premium Features"],
               url: {
                  monthly: "https://premast.com/checkout/?add-to-cart=1089065",
                  yearly: "https://premast.com/checkout/?add-to-cart=1089068",
               },
            },
         ];
      }
      render() {
         return y`
         <div id="plans-switch">
            <h4 class="label ${this.selectedDuration === this.durations[0] ? "active" : ""}">${this.durations[0]}</h4>
            <label id="switch">
               <input type="checkbox" @change=${this.togglePlans} />
               <span class="slider round"></span>
            </label>
            <div>
               <h4 class="label ${this.selectedDuration === this.durations[1] ? "active" : ""}">
                  ${this.durations[1]}
               </h4>
               <h5>Save 20%</h5>
            </div>
         </div>
         <div id="plans-table">
            ${this.plans.map(
               (plan) => y`
                  <div class="plan" id="${plan.name.toLowerCase()}">
                     <h2>${plan.name}</h2>
                     <h4>${plan.subtitle}</h4>
                     <div id="price">
                        ${this.renderPrice(plan)}
                        <h5>${this.selectedDuration}</h5>
                     </div>
                     <p>${plan.description}</p>
                     <ul>
                        ${plan.features.map(
                           (feature) => y`
                              <li>
                                 ${pmst_icons.checkCircle}
                                 <h5>${feature}</h5>
                              </li>
                           `
                        )}
                     </ul>
                     <a href=${plan.url[this.selectedDuration.toLowerCase()]} class="btn-primary-normal">Get Started</a>
                  </div>
               `
            )}
         </div>
      `;
      }
      togglePlans() {
         this.selectedDuration = this.selectedDuration === "Monthly" ? "Yearly" : "Monthly";
         console.log("selected duration: ", this.selectedDuration);
      }

      renderPrice(plan) {
         let price = plan.price[this.selectedDuration.toLocaleLowerCase()];
         let salePrice;
         if (plan.salePrice) {
            if (plan.salePrice[this.selectedDuration.toLocaleLowerCase()]) {
               salePrice = plan.salePrice[this.selectedDuration.toLocaleLowerCase()];
            }

            if (salePrice > 0) {
               return y`
               <h1 id="old-price">$${plan.price[this.selectedDuration.toLowerCase()]}</h1>
               <h1 id="current-price">$${salePrice}</h1>
            `;
            }
         }

         return y` <h1 id="current-price">$${price}</h1> `;
      }
   }

   if (!customElements.get("pmst-pricing-table")) {
      customElements.define("pmst-pricing-table", pmstPricingTable);
   }

   class CustomDesign extends s$3 {
      static get styles() {
         return i`
         ${colors}
         ${typo}
         ${buttons}
         #widget-wrapper {
            display: block;
            width: 100%;
            height: 100%;
            background-color: var(--color-netural-50);
            border: 1px solid var(--color-netural-100);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            padding: 32px;
            box-sizing: border-box;
            gap: 16px;
            height: auto;
         }
         #widget-header-title {
            display: flex;
            flex-direction: row;
         }
         #price {
            display: flex;
            flex-direction: row;
            align-items: center;
            color: var(--color-primary-300);
         }
         #widget-footer-content {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
         }

         #widget-footer-button {
            width: 80%;
            background-color: var(--color-primary-300);
            background-image: unset !important;
            color: var(--color-netural-50);
            border-radius: 50px;
            padding: 8px 16px;
            font-family: "Roboto";
            box-sizing: border-box;
            text-align: center;
            font-size: 18px;
            text-decoration: unset;
         }
      `;
      }

      render() {
         return y`
         <div id="widget-wrapper">
            <div id="widget-header">
               <div id="widget-header-title">
                  <h3>Let us design your presentation</h3>
                  <div id="price">
                     <h1>$5</h1>
                     <span>/slide</span>
                  </div>
               </div>
            </div>
            <div id="widget-body">
               <div id="widget-body-content">
                  <p>
                     Get your presentation custom designed by us, starting at just $5 per slide, get your presentation
                     designed based on this template style or any other tyle needed
                  </p>
               </div>
            </div>

            <div id="widget-footer">
               <div id="widget-footer-content">
                  <a href="https://premast.com/request" target="blank" id="widget-footer-button">Request Now</a>
               </div>
            </div>
         </div>
      `;
      }
   }
   if (!customElements.get("custom-design")) {
      customElements.define("custom-design", CustomDesign);
   }

   function createCommonjsModule(fn, module) {
   	return module = { exports: {} }, fn(module, module.exports), module.exports;
   }

   var webfontloader = createCommonjsModule(function (module) {
   /* Web Font Loader v1.6.28 - (c) Adobe Systems, Google. License: Apache 2.0 */(function(){function aa(a,b,c){return a.call.apply(a.bind,arguments)}function ba(a,b,c){if(!a)throw Error();if(2<arguments.length){var d=Array.prototype.slice.call(arguments,2);return function(){var c=Array.prototype.slice.call(arguments);Array.prototype.unshift.apply(c,d);return a.apply(b,c)}}return function(){return a.apply(b,arguments)}}function p(a,b,c){p=Function.prototype.bind&&-1!=Function.prototype.bind.toString().indexOf("native code")?aa:ba;return p.apply(null,arguments)}var q=Date.now||function(){return +new Date};function ca(a,b){this.a=a;this.o=b||a;this.c=this.o.document;}var da=!!window.FontFace;function t(a,b,c,d){b=a.c.createElement(b);if(c)for(var e in c)c.hasOwnProperty(e)&&("style"==e?b.style.cssText=c[e]:b.setAttribute(e,c[e]));d&&b.appendChild(a.c.createTextNode(d));return b}function u(a,b,c){a=a.c.getElementsByTagName(b)[0];a||(a=document.documentElement);a.insertBefore(c,a.lastChild);}function v(a){a.parentNode&&a.parentNode.removeChild(a);}
   function w(a,b,c){b=b||[];c=c||[];for(var d=a.className.split(/\s+/),e=0;e<b.length;e+=1){for(var f=!1,g=0;g<d.length;g+=1)if(b[e]===d[g]){f=!0;break}f||d.push(b[e]);}b=[];for(e=0;e<d.length;e+=1){f=!1;for(g=0;g<c.length;g+=1)if(d[e]===c[g]){f=!0;break}f||b.push(d[e]);}a.className=b.join(" ").replace(/\s+/g," ").replace(/^\s+|\s+$/,"");}function y(a,b){for(var c=a.className.split(/\s+/),d=0,e=c.length;d<e;d++)if(c[d]==b)return !0;return !1}
   function ea(a){return a.o.location.hostname||a.a.location.hostname}function z(a,b,c){function d(){m&&e&&f&&(m(g),m=null);}b=t(a,"link",{rel:"stylesheet",href:b,media:"all"});var e=!1,f=!0,g=null,m=c||null;da?(b.onload=function(){e=!0;d();},b.onerror=function(){e=!0;g=Error("Stylesheet failed to load");d();}):setTimeout(function(){e=!0;d();},0);u(a,"head",b);}
   function A(a,b,c,d){var e=a.c.getElementsByTagName("head")[0];if(e){var f=t(a,"script",{src:b}),g=!1;f.onload=f.onreadystatechange=function(){g||this.readyState&&"loaded"!=this.readyState&&"complete"!=this.readyState||(g=!0,c&&c(null),f.onload=f.onreadystatechange=null,"HEAD"==f.parentNode.tagName&&e.removeChild(f));};e.appendChild(f);setTimeout(function(){g||(g=!0,c&&c(Error("Script load timeout")));},d||5E3);return f}return null}function B(){this.a=0;this.c=null;}function C(a){a.a++;return function(){a.a--;D(a);}}function E(a,b){a.c=b;D(a);}function D(a){0==a.a&&a.c&&(a.c(),a.c=null);}function F(a){this.a=a||"-";}F.prototype.c=function(a){for(var b=[],c=0;c<arguments.length;c++)b.push(arguments[c].replace(/[\W_]+/g,"").toLowerCase());return b.join(this.a)};function G(a,b){this.c=a;this.f=4;this.a="n";var c=(b||"n4").match(/^([nio])([1-9])$/i);c&&(this.a=c[1],this.f=parseInt(c[2],10));}function fa(a){return H(a)+" "+(a.f+"00")+" 300px "+I(a.c)}function I(a){var b=[];a=a.split(/,\s*/);for(var c=0;c<a.length;c++){var d=a[c].replace(/['"]/g,"");-1!=d.indexOf(" ")||/^\d/.test(d)?b.push("'"+d+"'"):b.push(d);}return b.join(",")}function J(a){return a.a+a.f}function H(a){var b="normal";"o"===a.a?b="oblique":"i"===a.a&&(b="italic");return b}
   function ga(a){var b=4,c="n",d=null;a&&((d=a.match(/(normal|oblique|italic)/i))&&d[1]&&(c=d[1].substr(0,1).toLowerCase()),(d=a.match(/([1-9]00|normal|bold)/i))&&d[1]&&(/bold/i.test(d[1])?b=7:/[1-9]00/.test(d[1])&&(b=parseInt(d[1].substr(0,1),10))));return c+b}function ha(a,b){this.c=a;this.f=a.o.document.documentElement;this.h=b;this.a=new F("-");this.j=!1!==b.events;this.g=!1!==b.classes;}function ia(a){a.g&&w(a.f,[a.a.c("wf","loading")]);K(a,"loading");}function L(a){if(a.g){var b=y(a.f,a.a.c("wf","active")),c=[],d=[a.a.c("wf","loading")];b||c.push(a.a.c("wf","inactive"));w(a.f,c,d);}K(a,"inactive");}function K(a,b,c){if(a.j&&a.h[b])if(c)a.h[b](c.c,J(c));else a.h[b]();}function ja(){this.c={};}function ka(a,b,c){var d=[],e;for(e in b)if(b.hasOwnProperty(e)){var f=a.c[e];f&&d.push(f(b[e],c));}return d}function M(a,b){this.c=a;this.f=b;this.a=t(this.c,"span",{"aria-hidden":"true"},this.f);}function N(a){u(a.c,"body",a.a);}function O(a){return "display:block;position:absolute;top:-9999px;left:-9999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:"+I(a.c)+";"+("font-style:"+H(a)+";font-weight:"+(a.f+"00")+";")}function P(a,b,c,d,e,f){this.g=a;this.j=b;this.a=d;this.c=c;this.f=e||3E3;this.h=f||void 0;}P.prototype.start=function(){var a=this.c.o.document,b=this,c=q(),d=new Promise(function(d,e){function f(){q()-c>=b.f?e():a.fonts.load(fa(b.a),b.h).then(function(a){1<=a.length?d():setTimeout(f,25);},function(){e();});}f();}),e=null,f=new Promise(function(a,d){e=setTimeout(d,b.f);});Promise.race([f,d]).then(function(){e&&(clearTimeout(e),e=null);b.g(b.a);},function(){b.j(b.a);});};function Q(a,b,c,d,e,f,g){this.v=a;this.B=b;this.c=c;this.a=d;this.s=g||"BESbswy";this.f={};this.w=e||3E3;this.u=f||null;this.m=this.j=this.h=this.g=null;this.g=new M(this.c,this.s);this.h=new M(this.c,this.s);this.j=new M(this.c,this.s);this.m=new M(this.c,this.s);a=new G(this.a.c+",serif",J(this.a));a=O(a);this.g.a.style.cssText=a;a=new G(this.a.c+",sans-serif",J(this.a));a=O(a);this.h.a.style.cssText=a;a=new G("serif",J(this.a));a=O(a);this.j.a.style.cssText=a;a=new G("sans-serif",J(this.a));a=
   O(a);this.m.a.style.cssText=a;N(this.g);N(this.h);N(this.j);N(this.m);}var R={D:"serif",C:"sans-serif"},S=null;function T(){if(null===S){var a=/AppleWebKit\/([0-9]+)(?:\.([0-9]+))/.exec(window.navigator.userAgent);S=!!a&&(536>parseInt(a[1],10)||536===parseInt(a[1],10)&&11>=parseInt(a[2],10));}return S}Q.prototype.start=function(){this.f.serif=this.j.a.offsetWidth;this.f["sans-serif"]=this.m.a.offsetWidth;this.A=q();U(this);};
   function la(a,b,c){for(var d in R)if(R.hasOwnProperty(d)&&b===a.f[R[d]]&&c===a.f[R[d]])return !0;return !1}function U(a){var b=a.g.a.offsetWidth,c=a.h.a.offsetWidth,d;(d=b===a.f.serif&&c===a.f["sans-serif"])||(d=T()&&la(a,b,c));d?q()-a.A>=a.w?T()&&la(a,b,c)&&(null===a.u||a.u.hasOwnProperty(a.a.c))?V(a,a.v):V(a,a.B):ma(a):V(a,a.v);}function ma(a){setTimeout(p(function(){U(this);},a),50);}function V(a,b){setTimeout(p(function(){v(this.g.a);v(this.h.a);v(this.j.a);v(this.m.a);b(this.a);},a),0);}function W(a,b,c){this.c=a;this.a=b;this.f=0;this.m=this.j=!1;this.s=c;}var X=null;W.prototype.g=function(a){var b=this.a;b.g&&w(b.f,[b.a.c("wf",a.c,J(a).toString(),"active")],[b.a.c("wf",a.c,J(a).toString(),"loading"),b.a.c("wf",a.c,J(a).toString(),"inactive")]);K(b,"fontactive",a);this.m=!0;na(this);};
   W.prototype.h=function(a){var b=this.a;if(b.g){var c=y(b.f,b.a.c("wf",a.c,J(a).toString(),"active")),d=[],e=[b.a.c("wf",a.c,J(a).toString(),"loading")];c||d.push(b.a.c("wf",a.c,J(a).toString(),"inactive"));w(b.f,d,e);}K(b,"fontinactive",a);na(this);};function na(a){0==--a.f&&a.j&&(a.m?(a=a.a,a.g&&w(a.f,[a.a.c("wf","active")],[a.a.c("wf","loading"),a.a.c("wf","inactive")]),K(a,"active")):L(a.a));}function oa(a){this.j=a;this.a=new ja;this.h=0;this.f=this.g=!0;}oa.prototype.load=function(a){this.c=new ca(this.j,a.context||this.j);this.g=!1!==a.events;this.f=!1!==a.classes;pa(this,new ha(this.c,a),a);};
   function qa(a,b,c,d,e){var f=0==--a.h;(a.f||a.g)&&setTimeout(function(){var a=e||null,m=d||null||{};if(0===c.length&&f)L(b.a);else {b.f+=c.length;f&&(b.j=f);var h,l=[];for(h=0;h<c.length;h++){var k=c[h],n=m[k.c],r=b.a,x=k;r.g&&w(r.f,[r.a.c("wf",x.c,J(x).toString(),"loading")]);K(r,"fontloading",x);r=null;if(null===X)if(window.FontFace){var x=/Gecko.*Firefox\/(\d+)/.exec(window.navigator.userAgent),xa=/OS X.*Version\/10\..*Safari/.exec(window.navigator.userAgent)&&/Apple/.exec(window.navigator.vendor);
   X=x?42<parseInt(x[1],10):xa?!1:!0;}else X=!1;X?r=new P(p(b.g,b),p(b.h,b),b.c,k,b.s,n):r=new Q(p(b.g,b),p(b.h,b),b.c,k,b.s,a,n);l.push(r);}for(h=0;h<l.length;h++)l[h].start();}},0);}function pa(a,b,c){var d=[],e=c.timeout;ia(b);var d=ka(a.a,c,a.c),f=new W(a.c,b,e);a.h=d.length;b=0;for(c=d.length;b<c;b++)d[b].load(function(b,d,c){qa(a,f,b,d,c);});}function ra(a,b){this.c=a;this.a=b;}
   ra.prototype.load=function(a){function b(){if(f["__mti_fntLst"+d]){var c=f["__mti_fntLst"+d](),e=[],h;if(c)for(var l=0;l<c.length;l++){var k=c[l].fontfamily;void 0!=c[l].fontStyle&&void 0!=c[l].fontWeight?(h=c[l].fontStyle+c[l].fontWeight,e.push(new G(k,h))):e.push(new G(k));}a(e);}else setTimeout(function(){b();},50);}var c=this,d=c.a.projectId,e=c.a.version;if(d){var f=c.c.o;A(this.c,(c.a.api||"https://fast.fonts.net/jsapi")+"/"+d+".js"+(e?"?v="+e:""),function(e){e?a([]):(f["__MonotypeConfiguration__"+
   d]=function(){return c.a},b());}).id="__MonotypeAPIScript__"+d;}else a([]);};function sa(a,b){this.c=a;this.a=b;}sa.prototype.load=function(a){var b,c,d=this.a.urls||[],e=this.a.families||[],f=this.a.testStrings||{},g=new B;b=0;for(c=d.length;b<c;b++)z(this.c,d[b],C(g));var m=[];b=0;for(c=e.length;b<c;b++)if(d=e[b].split(":"),d[1])for(var h=d[1].split(","),l=0;l<h.length;l+=1)m.push(new G(d[0],h[l]));else m.push(new G(d[0]));E(g,function(){a(m,f);});};function ta(a,b){a?this.c=a:this.c=ua;this.a=[];this.f=[];this.g=b||"";}var ua="https://fonts.googleapis.com/css";function va(a,b){for(var c=b.length,d=0;d<c;d++){var e=b[d].split(":");3==e.length&&a.f.push(e.pop());var f="";2==e.length&&""!=e[1]&&(f=":");a.a.push(e.join(f));}}
   function wa(a){if(0==a.a.length)throw Error("No fonts to load!");if(-1!=a.c.indexOf("kit="))return a.c;for(var b=a.a.length,c=[],d=0;d<b;d++)c.push(a.a[d].replace(/ /g,"+"));b=a.c+"?family="+c.join("%7C");0<a.f.length&&(b+="&subset="+a.f.join(","));0<a.g.length&&(b+="&text="+encodeURIComponent(a.g));return b}function ya(a){this.f=a;this.a=[];this.c={};}
   var za={latin:"BESbswy","latin-ext":"\u00e7\u00f6\u00fc\u011f\u015f",cyrillic:"\u0439\u044f\u0416",greek:"\u03b1\u03b2\u03a3",khmer:"\u1780\u1781\u1782",Hanuman:"\u1780\u1781\u1782"},Aa={thin:"1",extralight:"2","extra-light":"2",ultralight:"2","ultra-light":"2",light:"3",regular:"4",book:"4",medium:"5","semi-bold":"6",semibold:"6","demi-bold":"6",demibold:"6",bold:"7","extra-bold":"8",extrabold:"8","ultra-bold":"8",ultrabold:"8",black:"9",heavy:"9",l:"3",r:"4",b:"7"},Ba={i:"i",italic:"i",n:"n",normal:"n"},
   Ca=/^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$/;
   function Da(a){for(var b=a.f.length,c=0;c<b;c++){var d=a.f[c].split(":"),e=d[0].replace(/\+/g," "),f=["n4"];if(2<=d.length){var g;var m=d[1];g=[];if(m)for(var m=m.split(","),h=m.length,l=0;l<h;l++){var k;k=m[l];if(k.match(/^[\w-]+$/)){var n=Ca.exec(k.toLowerCase());if(null==n)k="";else {k=n[2];k=null==k||""==k?"n":Ba[k];n=n[1];if(null==n||""==n)n="4";else var r=Aa[n],n=r?r:isNaN(n)?"4":n.substr(0,1);k=[k,n].join("");}}else k="";k&&g.push(k);}0<g.length&&(f=g);3==d.length&&(d=d[2],g=[],d=d?d.split(","):
   g,0<d.length&&(d=za[d[0]])&&(a.c[e]=d));}a.c[e]||(d=za[e])&&(a.c[e]=d);for(d=0;d<f.length;d+=1)a.a.push(new G(e,f[d]));}}function Ea(a,b){this.c=a;this.a=b;}var Fa={Arimo:!0,Cousine:!0,Tinos:!0};Ea.prototype.load=function(a){var b=new B,c=this.c,d=new ta(this.a.api,this.a.text),e=this.a.families;va(d,e);var f=new ya(e);Da(f);z(c,wa(d),C(b));E(b,function(){a(f.a,f.c,Fa);});};function Ga(a,b){this.c=a;this.a=b;}Ga.prototype.load=function(a){var b=this.a.id,c=this.c.o;b?A(this.c,(this.a.api||"https://use.typekit.net")+"/"+b+".js",function(b){if(b)a([]);else if(c.Typekit&&c.Typekit.config&&c.Typekit.config.fn){b=c.Typekit.config.fn;for(var e=[],f=0;f<b.length;f+=2)for(var g=b[f],m=b[f+1],h=0;h<m.length;h++)e.push(new G(g,m[h]));try{c.Typekit.load({events:!1,classes:!1,async:!0});}catch(l){}a(e);}},2E3):a([]);};function Ha(a,b){this.c=a;this.f=b;this.a=[];}Ha.prototype.load=function(a){var b=this.f.id,c=this.c.o,d=this;b?(c.__webfontfontdeckmodule__||(c.__webfontfontdeckmodule__={}),c.__webfontfontdeckmodule__[b]=function(b,c){for(var g=0,m=c.fonts.length;g<m;++g){var h=c.fonts[g];d.a.push(new G(h.name,ga("font-weight:"+h.weight+";font-style:"+h.style)));}a(d.a);},A(this.c,(this.f.api||"https://f.fontdeck.com/s/css/js/")+ea(this.c)+"/"+b+".js",function(b){b&&a([]);})):a([]);};var Y=new oa(window);Y.a.c.custom=function(a,b){return new sa(b,a)};Y.a.c.fontdeck=function(a,b){return new Ha(b,a)};Y.a.c.monotype=function(a,b){return new ra(b,a)};Y.a.c.typekit=function(a,b){return new Ga(b,a)};Y.a.c.google=function(a,b){return new Ea(b,a)};var Z={load:p(Y.load,Y)};module.exports?module.exports=Z:(window.WebFont=Z,window.WebFontConfig&&Y.load(window.WebFontConfig));}());
   });

   // import "~@flaticon/flaticon-uicons/css/all/all";

   function loadFonts() {
      webfontloader.load({
         google: {
            families: ["Roboto:400,500,700"],
         },
      });
   }

   var mainStyle$8 = i`
   ${colors}
   ${typo}
   ${animation}

   button {
      border: none;
      outline: none;
      cursor: pointer;
   }
   #header-container {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      height: 65px;
      background-color: var(--color-netural-50);
      border-bottom: 1px solid var(--color-netural-100);
      align-items: center;
      padding: 0 20px;
   }
   #header-left {
      display: flex;
      flex-direction: row;
      align-items: center;
      height: max-content;
      height: -webkit-max-content;
      height: -moz-max-content;
      gap: 32px;
   }
   #header-right {
      position: relative;
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 16px;
   }
   #logo-link {
      display: flex;
      flex-direction: row;
      align-items: center;
   }
   #logo-link img {
      max-width: 110px;
      min-width: 80px;
   }
   #nav {
      display: flex;
      flex-direction: row;
      align-items: center;
   }
   #nav ul {
      display: flex;
      flex-direction: row;
      align-items: center;
      list-style: none;
      margin: 0;
      padding: 0;
      gap: 20px;
   }
   #nav ul li a {
      color: var(--color-netural-700);
      text-decoration: none;
   }

   #pricing-btn {
      background-color: transparent;
      color: var(--color-netural-700);
      font-size: 16px;
      font-weight: 500;
   }
   #products-btn {
      display: flex;
      flex-direction: row;
      align-items: center;
      gap: 8px;
      background-color: var(--color-netural-100);
      color: var(--color-netural-700);
      border: 1px solid var(--color-netural-200);
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      padding: 8px 10px;
   }
   pmst-more-dropdown {
      position: absolute;
      top: 140%;
      right: 0;
      z-index: 999;
   }
   #more-icon.down {
      transform: rotate(180deg);
      transition: transform 0.2s cubic-bezier(0.86, 0.02, 0.45, 0.96);
   }
   #more-icon.up {
      transform: rotate(0deg);
      transition: transform 0.2s cubic-bezier(0.86, 0.02, 0.45, 0.96);
   }
`;

   class pmstMainHedaer extends s$3 {
      static get properties() {
         return {
            title: { type: String },
            logo: { type: String },
            nav: { type: Array },
            showProducts: { type: Boolean },
         };
      }

      static get styles() {
         return [mainStyle$8];
      }

      constructor() {
         super();
         this.title = "Premast";
         this.logo = "https://premast.com/app/uploads/2021/05/1-copy-4.svg";
         this.nav = [
            { name: "About", link: "https://premast.com/" },
            { name: "Blog", link: "https://premast.com/blog/" },
            { name: "Contact", link: "https://premast.com/contact/" },
         ];
      }

      render() {
         return y`
         <div id="header-container">
            <div id="header-left">
               <div id="header-logo">
                  <a href="https://premast.com/" id="logo-link">
                     <img src="${this.logo}" alt="premast" />
                  </a>
               </div>
               <div id="nav">
                  <ul>
                     ${this.nav.map(
                        (item) => y`
                           <li class="nav-text">
                              <a href="${item.link}">${item.name}</a>
                           </li>
                        `
                     )}
                  </ul>
               </div>
            </div>
            <div id="header-right">
               <button id="products-btn" @click=${this.toggleProductsDropdown}>
                  ${pmst_icons.more_icon} <span>products</span>
                  <div id="more-icon" class=${this.showProducts ? "down" : "up"}>${pmst_icons.arrow_down}</div>
               </button>
               ${this.showProducts
                  ? y` <pmst-more-dropdown source="premast" class="drop-in-animation"></pmst-more-dropdown> `
                  : ""}
            </div>
         </div>
      `;
      }
      toggleProductsDropdown() {
         this.showProducts = !this.showProducts;
      }
   }

   if (!customElements.get("pmst-main-header")) {
      customElements.define("pmst-main-header", pmstMainHedaer);
   }

   // import general components
   loadFonts();

})));
