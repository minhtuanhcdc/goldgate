<template>
      <table >
            <thead>
                <tr class="text-left" :class="addClass" >
                    <th class="py-2 z-50" v-for="(header,index) in headers" :key="`header-${index}`" :class="header.class || 'text-left'">
                     <span class="px-2" v-html="header.name"></span>                   
                     </th>                          
                </tr>
            </thead>
                <tbody>
                    <slot></slot>
                </tbody> 
        </table>

</template>
<script>
export default {
    props:{
        headers:{
            type:Array,
            required:true
        },
        addClass:{
            type:String,
            required:true
        }
    }

}

</script>

<style>
</style>