import{_ as s,r as c,o as i,c as a,a as l,b as n}from"./app-c5fa08c9.js";const p={name:"AdminSection",props:["title","imgSrc","href"]},g={class:"admin-section"},f=["src","alt"];function u(o,_,t,d,r,m){const e=c("v-button");return i(),a("section",g,[l("img",{src:t.imgSrc,alt:t.title,class:"admin-section-img"},null,8,f),n(e,{title:t.title,href:t.href},null,8,["title","href"])])}const v=s(p,[["render",u],["__scopeId","data-v-c7f4a247"]]);const h={name:"AdminIndex",components:{AdminSection:v}},x={class:"admin-section-wrapper"};function $(o,_,t,d,r,m){const e=c("admin-section");return i(),a("div",x,[n(e,{title:"Новости",href:"/admin/articles","img-src":"/images/postcard.svg"}),n(e,{title:"Фотогалерея",href:"/admin/photo-gallery","img-src":"/images/card-image.svg"}),n(e,{title:"Участники",href:"/admin/participants","img-src":"/images/people.svg"}),n(e,{title:"Сообщения",href:"/admin/messages","img-src":"/images/envelope.svg"})])}const y=s(h,[["render",$],["__scopeId","data-v-c2d85456"]]);export{y as default};