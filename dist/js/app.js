(()=>{var t,e={99:()=>{jQuery(document).ready((function(t){var e=t(".zinpee-table tbody tr").length;t(".zinpee-table").delegate(".button-delete","click",(function(t){t.preventDefault(),this.closest("tr").remove()})),t(".button-add").click((function(n){n.preventDefault(),e++,t(".zinpee-table tbody").append("<tr>\n                        <td>\n"+'                            <select name="zpdata['.concat(e,'][type]">\n')+'                                <option value="lazada">Lazada</option>\n                                <option value="tiki">Tiki</option>\n                                <option value="sendo">Sendo</option>\n                                <option value="shopee">Shopee</option>\n                                <option value="dienmayxanh">Điện máy xanh</option>\n                                <option value="thegioididong">Thế giới di động</option>\n                            </select>\n                        </td>\n'+'                        <td><input type="text" name="zpdata['.concat(e,'][price]"></td>\n')+'                        <td><input type="text" name="zpdata['.concat(e,'][url]"></td>\n')+'                        <td><input type="text" name="zpdata['.concat(e,'][buttonText]"></td>\n')+'                        <td style="width: 50px;"><button class="button-delete">Delete</button></td>\n                    </tr>')}))}))},258:()=>{}},n={};function o(t){var a=n[t];if(void 0!==a)return a.exports;var i=n[t]={exports:{}};return e[t](i,i.exports,o),i.exports}o.m=e,t=[],o.O=(e,n,a,i)=>{if(!n){var p=1/0;for(u=0;u<t.length;u++){for(var[n,a,i]=t[u],r=!0,l=0;l<n.length;l++)(!1&i||p>=i)&&Object.keys(o.O).every((t=>o.O[t](n[l])))?n.splice(l--,1):(r=!1,i<p&&(p=i));if(r){t.splice(u--,1);var d=a();void 0!==d&&(e=d)}}return e}i=i||0;for(var u=t.length;u>0&&t[u-1][2]>i;u--)t[u]=t[u-1];t[u]=[n,a,i]},o.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{var t={773:0,170:0};o.O.j=e=>0===t[e];var e=(e,n)=>{var a,i,[p,r,l]=n,d=0;if(p.some((e=>0!==t[e]))){for(a in r)o.o(r,a)&&(o.m[a]=r[a]);if(l)var u=l(o)}for(e&&e(n);d<p.length;d++)i=p[d],o.o(t,i)&&t[i]&&t[i][0](),t[i]=0;return o.O(u)},n=self.webpackChunkzinpee_affiliate=self.webpackChunkzinpee_affiliate||[];n.forEach(e.bind(null,0)),n.push=e.bind(null,n.push.bind(n))})(),o.O(void 0,[170],(()=>o(99)));var a=o.O(void 0,[170],(()=>o(258)));a=o.O(a)})();