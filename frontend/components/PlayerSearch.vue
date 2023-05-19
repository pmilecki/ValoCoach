<template>
  <div class="userSearch">
    <v-form>
      <input id="nick" type="text" placeholder="Nickname" class="bg-primaryRed rounded-md" required="true">

      <input id="tag"
             type="text"
             placeholder="Tag text"
             class="bg-primaryRed rounded-md"
             maxlength="5"
             required="true">

      <select id="server" class="bg-primaryRed rounded-md" required="true">
        <option value="EMEA">
          EMEA
        </option>

        <option value="NA">
          NA
        </option>
      </select>

      <select id="queueType" class="bg-primaryRed rounded-md" required="true">
        <option value="competitive">
          Competetive
        </option>
      </select>

      <input type="submit" value="Search">
    </v-form>
  </div>
</template>

<style>
input {
  margin-left: 8px;
  text-align: center;
}

select {
  margin-left: 8px;
  text-align: center;
}
</style>
