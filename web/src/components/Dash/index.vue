<template>
  <div id="page">
    {{setAccount()}}
    <div id="page-account-content">
      <article class="account-item">
        <header>
          <img class="hero-image" src="../../assets/img/brand.png" />
          <div class="account-data">
            <strong>{{account.holder}}</strong>
            <span>
              Agencia: {{account.agency}} - Conta: {{account.number}}
              <font-awesome-icon icon="sign-out-alt" color="red" v-on:click="logout()" />
            </span>
          </div>
        </header>
        <footer class="account-footer">
          <p>
            Saldo:
            <strong>R$ {{account.balance}}</strong>
          </p>
        </footer>
        <div class="actions">
          <input
            type="text"
            id="operationValue"
            v-model="operationValue"
            name="operationValue"
            placeholder="Valor do deposito / saque"
          />
          <button type="button" v-on:click="deposit()" class="deposit">depositar</button>
          <button type="button" v-on:click="withdraw()" class="withdraw">sacar</button>
        </div>
      </article>
    </div>
  </div>
</template>
<script>
export default {
  name: "DashBoard",
  data() {
    return {
      operationValue: "",
      account: {},
    };
  },
  methods: {
    setAccount() {
      if (!this.$store.getters.account.agency) {
        this.logout();
        return;
      }
      this.account = this.$store.getters.account;
    },
    deposit() {
      let formdata = new FormData();
      formdata.append("agency", this.account.agency);
      formdata.append("number", this.account.number);
      formdata.append("deposit", this.operationValue);

      fetch("http://localhost/cap/api/public/api/account/deposit", {
        method: "post",
        body: formdata,
      })
        .then((resp) => resp.json())
        .then((data) => {
          this.$alert(data);
          this.balance();
        })
        .catch((err) => {
          this.$danger(err);
        });
    },
    async withdraw() {
      const password = await this.$prompt("Confirme sua senha.");
      let formdata = new FormData();
      formdata.append("agency", this.account.agency);
      formdata.append("number", this.account.number);
      formdata.append("withdraw", this.operationValue);
      formdata.append("password", password);

      fetch("http://localhost/cap/api/public/api/account/withdraw", {
        method: "post",
        body: formdata,
      })
        .then((resp) => resp.json())
        .then((data) => {
          this.$alert(data.msg);
          this.balance();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    balance() {
      let formdata = new FormData();
      formdata.append("agency", this.account.agency);
      formdata.append("number", this.account.number);
      formdata.append("password", this.account.password);

      fetch("http://localhost/cap/api/public/api/account/balance", {
        method: "post",
        body: formdata,
      })
        .then((resp) => resp.json())
        .then((data) => {
          this.account.balance = data.balance;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    logout() {
      this.$router.back();
    },
  },
};
</script>
<style lang="css">
@import "./style.css";
@import "../../assets/styles/global.css";
@import "../../assets/styles/inputStyles.css";
</style>