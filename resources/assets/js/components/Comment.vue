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
                        @change=""
                    >
                    <div class="alert alert-danger" v-if="username_error">{{ username_error}}</div>
                </div>
                <div class="form-group">
                    <textarea name="" id="" class="form-control"  rows="6" placeholder="支持MarkDown语法"
                        v-model="content"
                        @change=""
                    ></textarea>
                    <div class="alert alert-danger" v-if="content_error">{{ content_error}}</div>
                </div>
                <div class="form-group">
                    <!--<div class="col-md-3 col-md-offset-4" >
                        <img src="/captcha"  alt="captcha" style="cursor: pointer" onclick="this.src='/captcha#'+Math.random()"/>
                        &lt;!&ndash;<img  :src="captcha_src" alt="" @click="switchCaptcha()" style="cursor: pointer">&ndash;&gt;
                        &lt;!&ndash;<img src="http://usr.im/200x50?text=null" width="100%" alt="">&ndash;&gt;
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" placeholder="请输入验证码" v-model="captcha">
                    </div>-->
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
                username_error : null,
                content_error : null,

            }
        },
        computed:{


        },
        created(){

             this.getCommentList();
        },
        methods:{
            /**
             * 分页是否为选中样式
             * @param index
             * @returns {boolean}
             */
            isActive(index){
                return this.current_page == index;
            },
            /**
             * 得到评论列表
             * @param url
             */
            getCommentList(url = '/api/comment'){
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
            /**
             * 评论提交
             */
            submitComment(){
                //清空error
                this.username_error = null;
                this.content_error = null;
                //axios提交到后端api
                axios.post('/api/comment', {
                    username: this.username,
                    content: this.content,
                    article_id :this.article_id,//props属性
                })
                .then(response=> {
                     if(response.data){
                         //弹出评论成功
                         layer.msg('评论成功', {icon: 1});
                         //清空输入框
                         this.username = null;
                         this.content = null;
                         //从新进行get请求comments数据
                        this.getCommentList(); //不带当前的页码的url,自动跳回第一页

//                         this.getCommentList('/api/comment?page='+this.current_page) //依旧留在当前页
                     }

                })
                .catch(error=> {
                    this.setError(error.response.data)
                });

            },

            setError(error_obj){
                //添加用户名的错误
                if(error_obj.username){
                    this.username_error = error_obj.username[0];
                }
                if( error_obj.content){
                    //添加评论内容的错误
                    this.content_error = error_obj.content[0];
                }


            },
        }
    }
</script>
<style>

</style>