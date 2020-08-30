<template>
  <div id="page-landing">
    <div id="page-landing-content">
      <article class="teacher-item">
        <header>
          <img src="{teacher.avatar}" />
          <div>
            <strong>{teacher.name}</strong>
            <span>{teacher.subject}</span>
          </div>
        </header>

        <p>{teacher.bio}</p>
        <footer class="teacher-footer">
          <p>
            Preço/Hora
            <strong>R$ {teacher.cost}</strong>
          </p>
        </footer>
      </article>
    </div>
  </div>
</template>
<script>
export default {
  name: "DashBoard",
};
</script>
<style lang="css">
@import "./style.css";
@import "../../assets/styles/global.css";
@import "../../assets/styles/styles.css";
@import "../../assets/styles/inputStyles.css";
</style>