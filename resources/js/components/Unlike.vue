<script setup>
 async function unlike(event) {
try {
  const response = await axios.delete('/unlike/', { id: id, model: model })
  console.log(response.data.message)
} catch (e) {
  console.log(e.response.data.message)
}
}
</script>

<template>
  <div>

  </div>

</template>