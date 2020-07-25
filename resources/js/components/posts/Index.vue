<template>
  <div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">
            POSTS
          </div>

          <div class="card-body">
            <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">Tambah Post</router-link>

            <div class="table-responsive mt-2">
              <!-- <data-table
                :url="url"
                :columns="columns"
                :per-page="perPage">
              </data-table> -->
              <table class="table table-hover table-bordered">
                <thead class="bg-primary text-white">
                  <tr>
                    <th>TITLE</th>
                    <th>CONTENT</th>
                    <th>AKSI</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(post, index) in posts" :key="post.id">
                    <td width="20%">{{ post.title }}</td>
                    <td class="text-justify">{{ post.content }}</td>
                    <td class="text-center" nowrap>
                      <router-link :to="{ name: 'edit', params: {id:post.id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></router-link>
                      <button @click.prevent="PostDelete(post.id, Index)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        posts: [],
        // url: 'http://localhost:8000/api/posts',
        // perPage: ['10', '25', '50'],
        // columns: [
        //     {
        //         label: 'Title',
        //         name: 'title',
        //         filterable: true,
        //     },
        //     {
        //         label: 'Content',
        //         name: 'content',
        //         filterable: true,
        //     }
        //   ],
      }
    },
    created(){
      let uri = `http://localhost:8000/api/posts`;
      this.axios.get(uri).then(response => {
        this.posts = response.data.data;
      });
    },
    methods:{
      PostDelete(id, index){
        this.axios.delete(`http://localhost:8000/api/posts/${id}`)
            .then(response => {
              this.posts.splice(index,1);
            }).catch(error => {
              alert("System Error");
            });
      }

    }
  }
</script>
