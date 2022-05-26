<template>
      <table >
            <thead>
                <tr class="" :class="addClass" >
                    <th class=" z-50" v-for="(header,index) in headers" :key="`header-${index}`" :class="header.class || 'text-left'">
                     <span class="" v-html="header.name"></span>                   
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