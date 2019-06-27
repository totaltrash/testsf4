<template>
    <b-navbar toggleable="lg" type="dark" variant="primary">
        <b-navbar-brand href="#" v-text="title"></b-navbar-brand>
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-collapse id="nav-collapse" is-nav>
            <slot></slot>
        </b-collapse>
    </b-navbar>
</template>

<script>
export default {
  props: {
    title: String
  }
}
</script>
