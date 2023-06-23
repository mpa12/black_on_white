import{_ as m,f as r,r as p,o,c as a,a as i,h as f,w as b,e as x,i as c,l as d,m as w,F as v,g as k,q as A,t as g,k as F,p as y,d as U}from"./app-c5fa08c9.js";const B={name:"ArticleSearch",data(){return{filters:[],selectedFilters:[],text:"",isAdmin:!1,showFilters:!1}},methods:{filterButton(){this.showFilters=!this.showFilters},loadFilters(){r.get("/api/article-type/").then(t=>{this.filters=t.data.data})},search(){let t=new CustomEvent("search",{detail:{selectedFilters:this.selectedFilters,text:this.text}});window.dispatchEvent(t)},checkIsAdmin(){const t=localStorage.getItem("token");if(!t){this.isAdmin=!1;return}r.get("/api/auth/is-admin",{headers:{Authorization:`Bearer ${t}`}}).then(e=>{this.isAdmin=!!e.data}).catch(e=>{console.log(e),this.isAdmin=!1})}},mounted(){this.loadFilters(),this.checkIsAdmin()}},h=t=>(y("data-v-5b8b086b"),t=t(),U(),t),S={class:"newses__search"},V={class:"w-100 d-flex align-items-center gap-2 justify-content-between"},P={class:"flex-grow-1"},C=h(()=>i("path",{d:"M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"},null,-1)),E=[C],I=h(()=>i("button",{type:"submit"},"Найти",-1)),L={key:0,class:"d-flex flex-wrap gap-2 mt-2"},z=["value","id"],M=["for"];function R(t,e,N,D,l,n){const _=p("router-link");return o(),a("div",S,[i("form",{class:"d-flex flex-column",onSubmit:e[3]||(e[3]=F((...s)=>n.search&&n.search(...s),["prevent"]))},[i("div",V,[l.isAdmin?(o(),f(_,{key:0,class:"btn btn-primary",to:"/admin/articles/create"},{default:b(()=>[x("Добавить")]),_:1})):c("",!0),i("label",P,[d(i("input",{"onUpdate:modelValue":e[0]||(e[0]=s=>l.text=s),type:"text",placeholder:"Введите название новости...",class:"w-100"},null,512),[[w,l.text]])]),(o(),a("svg",{onClick:e[1]||(e[1]=(...s)=>n.filterButton&&n.filterButton(...s)),width:"16",height:"16",fill:"currentColor",class:"bi bi-filter",viewBox:"0 0 16 16"},E)),I]),l.showFilters?(o(),a("div",L,[(o(!0),a(v,null,k(l.filters,s=>(o(),a("span",null,[d(i("input",{"onUpdate:modelValue":e[2]||(e[2]=u=>l.selectedFilters=u),type:"checkbox",class:"btn-check",value:s.id,id:s.id,autocomplete:"off",name:"selectedFilters"},null,8,z),[[A,l.selectedFilters]]),i("label",{class:"btn btn-outline-dark",for:s.id},g(s.title),9,M)]))),256))])):c("",!0)],32)])}const j=m(B,[["render",R],["__scopeId","data-v-5b8b086b"]]);export{j as A};
