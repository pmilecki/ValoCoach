<template>
  <div class="userSearch">
    <form>
      <input id="nick"
             v-model="nick"
             name="nick"
             type="text"
             placeholder="Nickname"
             class="bg-primaryRed rounded-md p-1"
             required="true">

      <input id="tag"
             v-model="tag"
             name="tag"
             type="text"
             placeholder="Tag text"
             class="bg-primaryRed rounded-md p-1"
             maxlength="5"
             required="true">

      <select id="server" v-model="server" name="server" class="bg-primaryRed rounded-md p-1" required="true">
        <option value="eu">
          EU
        </option>

        <option value="na">
          NA
        </option>
      </select>

      <select id="queueType" v-model="queueType" name="queueType" class="bg-primaryRed rounded-md p-1" required="true">
        <option value="competitive">
          Competetive
        </option>

        <option value="unrated">
          Unrated
        </option>

        <option value="spikerush">
          Spike Rush
        </option>

        <option value="swiftplay">
          Swiftplay
        </option>
      </select>

      <input type="submit" value="Search" class="bg-primaryRed rounded-md p-1" @click.stop.prevent="searchPlayer()">
    </form>
  </div>
</template>

<script lang="ts">
export default {
  data() {
    return {
      nick: '',
      tag: '',
      server: '',
      queueType: '',
    }
  },

  methods: {
    searchPlayer() {
      if (document.querySelector('form')?.checkValidity()) {
        this.$router.push(`/${this.server}/${this.nick}/${this.tag}/${this.queueType}`)
      }
    },
  },
}
</script>

<style>
input {
  margin-left: 8px;
  text-align: center;
}

select {
  margin-left: 8px;
  text-align: center;
}

input::placeholder {
  color: #4d4d4d60;
}
</style>
