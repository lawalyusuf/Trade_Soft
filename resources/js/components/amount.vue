<template>
    <span>
        {{ amount | currency }}
    </span>

</template>

<script>
export default {
    props:{
        amount: [String]
    }
}
</script>
