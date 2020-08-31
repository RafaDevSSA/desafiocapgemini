<template>
  <div id="page-landing">
    <div id="page-landing-content">
      <div class="logo-container">
        <img alt="Logo Capgemini" src="../../assets/img/brand.png" />
        <h2>Internet Bancking Capgemini</h2>
      </div>
      <img class="hero-image" src="../../assets/img/banner.png" />
      <form id="login">
        <div class="input-block">
          <label for="agency">Agencia</label>
          <input type="text" id="agency" v-model="agency" name="agency" />
        </div>
        <div class="input-block">
          <label for="number">Conta</label>
          <input type="text" id="number" v-model="number" name="number" />
        </div>
        <div class="input-block">
          <label for="password">Senha</label>
          <input type="text" id="password" v-model="password" name="password" />
        </div>
        <div class="input-block">
          <button v-on:click="login()" type="button">entrar na conta</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
//import { API } from "../provider/api";
export default {
  name: "Login",
  props: {
    number: String,
    agency: String,
    password: String,
  },
  methods: {
    login: function () {
      let request = new FormData();
      request.append("number", this.number);
      request.append("agency", this.agency);
      request.append("password", this.password);

      fetch("http://localhost/cap/api/public/api/account/login", {
        method: "post",
        body: request,
      })
        .then((data) => {
          let credentials = data.json().credentials;
          credentials.password = this.password;
          this.$store.commit("setAccount", credentials);
          this.$router.push("/dash");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>
<style lang="css">
@import "../../assets/styles/global.css";
@import "../../assets/styles/styles.css";
@import "../../assets/styles/inputStyles.css";
</style>