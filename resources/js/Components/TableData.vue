<template>
      <table id="myTable">
            <thead>
                <tr class="text-left">
                    <th class="" v-for="(header,index) in headers" :key="`header-${index}`"
                              :class="header.class || 'text-left'"
                     >
                     <div class="flex">
                     <span>{{header.name}}</span>
                      <span class="text-gray-400 ml-1 cursor-pointer">
                      </span>
                     </div>
                     </th>                          
                </tr>
            </thead>
                <tbody>
                    <slot></slot>
                </tbody> 
        </table>
</template>

<script>
import $ from "jquery";
export default {
    props:{
        headers:{
            type:Array,
            required:true
        }
    },
        mounted() {
              $("#myTable").DataTable({
                    "search": {                     
                        "search":'',
                        className:'bg-red-400'
                    },
                    dom:"Bfrtip",
                         buttons: {
                             className:'justify-between',
                            buttons: [
                                { extend: 'pageLength', className: 'mr-20 bg-blue-800' },
                                { extend: 'copy', className: 'bg-cyan-400 bg-cyan-500 border-cyan-600'  },
                                { extend: 'print', className: 'mx-1 bg-cyan-600 border-cyan-600' },
                               {
                                // text: '<i class="fa fa-lg fas-file-text-o"></i>',
                                text:'xuat file Excel',
                                    extend: 'csv',
                                    className: 'bg-cyan-600 border-cyan-600',
                                    title: 'export_filename',
                                    extension: '.xls'
                                },
                                {
                                text: 'Excel',
                                extend: 'excel',
                                className: 'bg-cyan-700',
                                title: 'export_filename',
                                extension: '.xls'
                            }, 
                              
                            ],    
                                              
                    },
               
                     scrollY:480,                                        
                    lengthMenu: [
                        [ 10, 25, 50, -1 ],
                        [ '10 rows', '25 rows', '50 rows', 'All' ]
                    ],                              
                    });
               
                    //table.buttons( 'csv:name' ).disable();
        
        
        },

}
</script>
<style>
.dt-buttons{
left:2%;
margin-bottom: 4px;
}
.dataTables_filter input{
    border-radius: 5px;
    height: 30px;
      background-color: white;
   
}
div.dataTables_filter,
div.dataTables_length {
    margin-top: 0px;
     padding: 0px;
  
    float: right;
}

  .dataTables_wrapper .dataTables_info{
      color:blue;
      margin-right: 10px;
      display: inline-flex;
  }
  
.dataTables_wrapper .dataTables_paginate {
float:right;
  text-align: center;
}
</style>