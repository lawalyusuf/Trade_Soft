<template>
    <span>
        {{ time | timeAgo }}
    </span>

</template>

<script>
export default {
    props:{
        time: [String]
    }
}
</script>
