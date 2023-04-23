<template>
  <div class="userSearch">
    <form>
      <input type="text" placeholder="Nickname" class="rounded-md" required="true">
      <input type="text" placeholder="Tag text" class="rounded-md" maxlength="5" required="true">
      <select class="rounded-md" required="true">
        <option value="EMEA">
          EMEA
        </option>
        <option value="NA">
          NA
        </option>
      </select>
      <select class="rounded-md" required="true">
        <option value="competetive">
          Competetive
        </option>
      </select>
      <input type="submit" value="Search">
    </form>
  </div>
</template>

<style>
  input{
    margin-left: 8px;
    text-align: center;
  }
  input[type=submit]{
    color: white;
  }
  select{
    margin-left: 8px;
    text-align: center;
  }
</style>
