function sprintf(){var e=/%%|%(\d+\$)?([-+\'#0 ]*)(\*\d+\$|\*|\d+)?(\.(\*\d+\$|\*|\d+))?([scboxXuidfegEG])/g,r=arguments,t=0,n=r[t++],a=function(e,r,t,n){t||(t=" ");var a=e.length>=r?"":Array(1+r-e.length>>>0).join(t);return n?e+a:a+e},c=function(e,r,t,n,c,i){var s=n-e.length;return s>0&&(e=t||!c?a(e,n,i,t):e.slice(0,r.length)+a("",s,"0",!0)+e.slice(r.length)),e},i=function(e,r,t,n,i,s,u){var o=e>>>0;return t=t&&o&&{2:"0b",8:"0",16:"0x"}[r]||"",e=t+a(o.toString(r),s||0,"0",!1),c(e,t,n,i,u)},s=function(e,r,t,n,a,i){return null!=n&&(e=e.slice(0,n)),c(e,"",r,t,a,i)},u=function(e,n,u,o,f,h,l){var d,g,b,p,x;if("%%"==e)return"%";for(var v=!1,w="",E=!1,k=!1,m=" ",A=u.length,C=0;u&&A>C;C++)switch(u.charAt(C)){case" ":w=" ";break;case"+":w="+";break;case"-":v=!0;break;case"'":m=u.charAt(C+1);break;case"0":E=!0;break;case"#":k=!0}if(o=o?"*"==o?+r[t++]:"*"==o.charAt(0)?+r[o.slice(1,-1)]:+o:0,0>o&&(o=-o,v=!0),!isFinite(o))throw new Error("sprintf: (minimum-)width must be finite");switch(h=h?"*"==h?+r[t++]:"*"==h.charAt(0)?+r[h.slice(1,-1)]:+h:"fFeE".indexOf(l)>-1?6:"d"==l?0:void 0,x=n?r[n.slice(0,-1)]:r[t++],l){case"s":return s(String(x),v,o,h,E,m);case"c":return s(String.fromCharCode(+x),v,o,h,E);case"b":return i(x,2,k,v,o,h,E);case"o":return i(x,8,k,v,o,h,E);case"x":return i(x,16,k,v,o,h,E);case"X":return i(x,16,k,v,o,h,E).toUpperCase();case"u":return i(x,10,k,v,o,h,E);case"i":case"d":return d=parseInt(+x),g=0>d?"-":w,x=g+a(String(Math.abs(d)),h,"0",!1),c(x,g,v,o,E);case"e":case"E":case"f":case"F":case"g":case"G":return d=+x,g=0>d?"-":w,b=["toExponential","toFixed","toPrecision"]["efg".indexOf(l.toLowerCase())],p=["toString","toUpperCase"]["eEfFgG".indexOf(l)%2],x=g+Math.abs(d)[b](h),c(x,g,v,o,E)[p]();default:return e}};return n.replace(e,u)}