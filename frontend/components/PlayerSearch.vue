<template>
  <div class="userSearch">
    <form>
      <input type="text" class="rounded-md" required="true">
      <input type="text" class="rounded-md" maxlength="5" required="true">
      <select class="rounded-md" required="true">
        <option value="EMEA">
          EMEA
        </option>
        <option value="NA">
          NA
        </option>
      </select>
      <input type="submit" value="Search">
    </form>
  </div>
</template>

<style>
  input{
    margin-left: 8px;
  }
  input[type=submit]{
    color: white;
  }
  select{
    margin-left: 8px;
    text-align: center;
  }
</style>
