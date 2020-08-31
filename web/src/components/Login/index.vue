<template>
  <div id="page">
    <div id="page-content">
      <div class="logo-container">
        <img alt="Logo Capgemini" src="../../assets/img/brand.png" />
        <h2>Internet Banking Capgemini</h2>
      </div>
      <img class="brand-image" src="../../assets/img/banner.png" />
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
          <button v-on:click="login()" type="button">{{loading ? 'Carregando' : 'entrar na conta'}}</button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
//import { API } from "../provider/api";
export default {
  name: "Login",
  data() {
    return {
      loading: false,
      number: "",
      agency: "",
      password: "",
    };
  },
  methods: {
    login: function () {
      this.loading = !this.loading;
      let request = new FormData();
      request.append("number", this.number);
      request.append("agency", this.agency);
      request.append("password", this.password);

      fetch("http://localhost/cap/api/public/api/account/login", {
        method: "post",
        body: request,
      })
        .then(async (data) => {
          this.loading = !this.loading;
          if (data.status == "403") {
            this.$alert("Conta não encontrada.");
            return false;
          }
          let response = await data.json();
          let credentials = response.credentials;
          credentials.password = this.password;
          this.$store.commit("setAccount", credentials);
          this.$router.push("/dash");
        })
        .catch((err) => {
          this.loading = !this.loading;
          console.log(err);
          this.$danger("Falha ao buscar informações.");
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