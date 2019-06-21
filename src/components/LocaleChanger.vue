<template>
    <div class="locale-changer form-inline">
        <select v-model="$i18n.locale" class="form-control">
            <option v-for="(lang, i) in langs" :key="`Lang${i}`" :value="lang">{{ lang }}</option>
        </select>
    </div>
</template>

<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';

    @Component({})
    export default class LocaleChanger extends Vue {
        protected langs: string[] = ['en', 'nl'];
    }
</script>


