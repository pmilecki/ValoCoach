<template>
  <div class="userSearch">
    <form>
      <input id="nick" type="text" placeholder="Nickname" class="rounded-md" required="true">

      <input id="tag"
             type="text"
             placeholder="Tag text"
             class="rounded-md"
             maxlength="5"
             required="true">

      <select id="server" class="rounded-md" required="true">
        <option value="EMEA">
          EMEA
        </option>

        <option value="NA">
          NA
        </option>
      </select>

      <select id="queueType" class="rounded-md" required="true">
        <option value="competetive">
          Competetive
        </option>
      </select>

      <input type="submit" value="Search">
    </form>
  </div>
</template>

<style>
input {
  margin-left: 8px;
  text-align: center;
}
input[type='submit'] {
  color: white;
}
select {
  margin-left: 8px;
  text-align: center;
}
</style>
