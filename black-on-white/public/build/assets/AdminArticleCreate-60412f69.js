import{A as l}from"./AdminArticleForm-a37aeea5.js";import{T as _}from"./Toast-946d871f.js";import{_ as f,U as u,r as i,o as a,c as h,h as d,i as A,F as v,p as y,d as C,a as m}from"./app-e9fbd619.js";import"./_commonjsHelpers-87174ba5.js";const g={name:"AdminArticleCreate",components:{AdminArticleForm:l,Toast:_},data(){return{formData:null,created:!1,formKey:0}},mounted(){window.addEventListener("getData",function(e){this.formData=e.detail.formData,this.create(this.formData)}.bind(this))},methods:{create(e){const s="/api/article",n={headers:{"Content-Type":"multipart/form-data",Authorization:u.getAuthorizationString()}};axios.post(s,e,n).then(()=>{this.created=!0,this.formKey++}).catch(r=>{if(r.response.status===422){let t=JSON.parse(r.request.responseText).errors;for(const o in t)t[o]=t[o][0];let c=new CustomEvent("setErrors",{detail:{errors:t}});window.dispatchEvent(c)}})}}},k=e=>(y("data-v-2ecdfb4d"),e=e(),C(),e),w=k(()=>m("div",{class:"article-form-title my-3"},[m("h1",null,"Добавление новости")],-1));function x(e,s,n,r,t,c){const o=i("toast"),p=i("admin-article-form");return a(),h(v,null,[t.created?(a(),d(o,{key:0,title:"Новость успешно добавлена"})):A("",!0),w,(a(),d(p,{key:t.formKey}))],64)}const B=f(g,[["render",x],["__scopeId","data-v-2ecdfb4d"]]);export{B as default};
