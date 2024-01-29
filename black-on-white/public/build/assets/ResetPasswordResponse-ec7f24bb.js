import{T as _}from"./Toast-844761a0.js";import{_ as m,r as u,o as r,c as n,h,i as a,a as o,l as w,m as k,t as b,k as f,F as v,p as y,d as x}from"./app-b67aaecc.js";const P={name:"ResetPasswordResponse",components:{Toast:_},data(){return{remember_token:null,token_valid:!0,new_password:null,errors:[],success:!1}},mounted(){this.remember_token=this.$route.params.remember_token,this.tokenIsValid()},methods:{tokenIsValid(){axios.post("/api/auth/validate-token",{remember_token:this.remember_token}).then(()=>{this.token_valid=!0}).catch(s=>{console.log(s),this.token_valid=!1})},resetPassword(){axios.post("/api/auth/reset-password-response",{remember_token:this.remember_token,new_password:this.new_password}).then(()=>{this.new_password=null,this.errors=[],this.success=!0}).catch(s=>{if(console.log(s),s.response.status===422){let e=JSON.parse(s.request.responseText).errors;for(const l in e)e[l]=e[l][0];this.errors=e}})}}},d=s=>(y("data-v-d8d69449"),s=s(),x(),s),g={key:1,class:"invalid-token"},I=d(()=>o("h3",null,"Пользователь не найден",-1)),R=[I],S={key:2,class:"reset-password-response"},V=d(()=>o("h1",{class:"mb-4"},"Восстановление пароля",-1)),B={class:"mb-3"},T=d(()=>o("label",{for:"password",class:"form-label"},"Пароль",-1)),N={key:0,class:"text-danger"},C=d(()=>o("button",{type:"submit",class:"btn btn-circle mb-4"},"Восстановить пароль",-1));function D(s,e,l,F,t,p){const c=u("toast");return r(),n(v,null,[t.success?(r(),h(c,{key:0,title:"Пароль успешно изменен"})):a("",!0),t.token_valid?a("",!0):(r(),n("section",g,R)),t.token_valid?(r(),n("section",S,[o("form",{class:"reset-password-response-wrapper",onSubmit:e[1]||(e[1]=f((...i)=>p.resetPassword&&p.resetPassword(...i),["prevent"]))},[V,o("div",B,[T,w(o("input",{"onUpdate:modelValue":e[0]||(e[0]=i=>t.new_password=i),type:"password",class:"form-control",id:"password",placeholder:"Введите новый пароль"},null,512),[[k,t.new_password]]),t.errors.hasOwnProperty("new_password")?(r(),n("small",N,b(t.errors.new_password),1)):a("",!0)]),C],32)])):a("",!0)],64)}const q=m(P,[["render",D],["__scopeId","data-v-d8d69449"]]);export{q as default};