<template>
<!--定义模板-->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>评论</h4>
        </div>
        <div class="panel-body">
            <div>
                <ul class="list-unstyled">
                    <li class="comment" v-for="comment in comments">
                        <div>
                            <div class="row">
                                <div class="col-md-10">
                                    <h3>{{ comment.username }} :</h3>
                                </div>
                            </div>


                            <p>
                              {{ comment.content }}
                            </p>
                            <br>
                            <span class="pull-right">
                                {{ comment.created_at}}
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <!--<li class="comment">
                        <div>
                            <h3>1101140857@qq.com :</h3>
                            <p>
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                            </p>
                            <br>
                            <span class="pull-right">
                                            2017年02月21日17:25:29
                                        </span>
                            <div class="clearfix"></div>
                        </div>
                    </li>
                    <li class="comment">
                        <div>
                            <h3>1101140857@qq.com :</h3>
                            <p>
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                                文章对我的帮助很大,但是有几个地方仍然需要改进
                            </p>
                            <br>
                            <span class="pull-right">
                                            2017年02月21日17:25:29
                                        </span>
                            <div class="clearfix"></div>
                        </div>
                    </li>-->
                </ul>
                <div class="text-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <!--当prev_page_url不存在(false) 时我希望的时,不显示,disabled为true-->
                            <li
                                    @click="getCommentList(prev_page_url)"
                                    :class="{disabled:!prev_page_url}"
                            >
                                <a href="javascript:void(0)" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>

                            <li v-for="index in indexs"
                                @click="getCommentList('/api/comment?page='+index)"
                                :class="{active:isActive(index)}"
                            ><a
                                    href="javascript:void(0)"

                            >{{ index }}</a></li>

                            <li
                                    @click="getCommentList(next_page_url)"
                                    :class="{disabled:!next_page_url}"
                            >
                                <a href="javascript:void(0)" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <hr>
                <div class="form-group">
                    <input
                        type="text" class="form-control" placeholder="自定义用户名 例: 1101140857@qq.com"
                        v-model="username"
                    >
                </div>
                <div class="form-group">
                    <textarea name="" id="" class="form-control"  rows="6" placeholder="支持MarkDown语法"
                        v-model="content"
                    ></textarea>
                </div>
                <div class="form-group">
                    <div class="col-md-3 col-md-offset-4">
                        <img src="http://usr.im/200x50?text=null" width="100%" alt="">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="请输入验证码">
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-success" @click="submitComment()">提交评论</button>
                    </div>
                </div>
        </div>

    </div>
</template>
<script>
    /*组件选项定义,包括data,methods,等*/
    export default {
        props: ['article_id'],
        data () {
            return {
                username :null,
                content : null,
                comments:[],
                indexs:[],
                next_page_url:null,
                prev_page_url:null,
                last_page:null,
                current_page:null,
                per_pager:null,
                total:null,

            }
        },
        computed:{

        },
        created(){
             this.getCommentList('/api/comment');
        },
        methods:{
            isActive(index){
                return this.current_page == index;
            },
            getCommentList(url){
                if(url){
                    axios.get(url, {
                        params: {
                            article_id: this.article_id,
                        }
                    })
                    .then(response=> {
                        //评论列表
                        this.comments = response.data.data;
                        //分页样式
                        this.total = response.data.total;
                        this.per_pager = response.data.per_pager; //每页记录数
                        this.current_page = response.data.current_page;
                        this.next_page_url = response.data.next_page_url;
                        this.prev_page_url = response.data.prev_page_url;
                        this.last_page = response.data.last_page; //页码数
                        /**
                         * 填充一个页码数
                         */
                        this.indexs = [];
                        for(var i=1;i<=this.last_page;i++){
                            this.indexs.push(i);
                        }

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                }

            },
            submitComment(){
                //axios提交到后端api
                 console.log(this.username);
                 console.log(this.content);
                axios.post('/api/comment', {
                    params: {
                        username: this.username,
                        content: this.content,
                    }
                })
                .then(response=> {
                     console.log(response);

                })
                .catch(error=> {
                    console.log(error);
                });

            }

        }
    }
</script>
<style>

</style>