<template>
    <span>
        {{ sign }}{{ amount | currency }}

    </span>

</template>

<script>
export default {
    props:{
        amount: [Number, String],
        sign: [String]
    }
}
</script>
