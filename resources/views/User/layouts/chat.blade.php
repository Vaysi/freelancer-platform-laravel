<div id="vue">
    <div aria-live="polite" aria-atomic="true" style="position: absolute; min-height: 200px;">
        <div class="toast" style="position: fixed; top: 15px; right: 15px;z-index: 15000">
            <div class="toast-header">
                <div class="d-inline-block rounded ml-2 bg-info text-white text-center" style="width: 20px;height: 20px;"><i class="fa fa-info align-middle"></i></div>
                <strong class="ml-auto">@{{ lastTitle }}</strong>
                <small class="text-muted">@{{ lastTime }}</small>
                <button type="button" class="mr-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body text-right">
                @{{ lastMsg }}
            </div>
        </div>
    </div>
    <div id="chatWrapper" class="collapse animated fadeInDown">
        <div id="frame" class="d-flex">
            <button data-toggle="collapse" data-target="#chatWrapper" class="btn-circle-md btn-danger btn position-absolute" style="top: -15px;left: -15px;z-index: 5;"><i class="fa fa-close"></i></button>
            <div id="sidepanel">
                <div id="profile">
                    <div class="wrap">
                        <img id="profile-img" src="{{ user()->avatar }}" class="online" alt="" />
                        <p>{{ user()->name }}</p>
                    </div>
                </div>
                <div id="contacts">
                    <ul>
                        <li class="contact" v-for="user in users"
                            :key="user.id"
                            @click="openChat(userID == user.to.id ? user.user.id : user.to.id,user.project.id)"
                            :class="{'font-weight-bold': chatUserID === user.id}" :id="'p'+user.project.id">
                            <div class="wrap">
                                <img :src="userID == user.to.id ? user.user.avatar : user.to.avatar">
                                <div class="meta">
                                    <p class="name">@{{ user.project.title }} <br> <small>@{{ userID == user.to.id ? user.user.nicky : user.to.nicky }}</small></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content" v-show="chatOpen && !loadingMessages">
                <div class="messages" ref="messageBox">
                    <ul>
                        <li v-for="message in messages"
                            :class="{'replies': message.user_id != chatUserID , 'sent' : message.user_id == chatUserID }">
                            <img :src="message.sender.avatar">
                            <p v-b-tooltip.hover.top="message.created_at">
                            <span class="text-right d-block">
                                @{{ message.content }}
                            </span>
                                <small :class="{'text-secondary': message.user_id != chatUserID , 'text-white' : message.user_id == chatUserID }">@{{ message.ago }}</small>
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="message-input">
                    <div class="wrap">
                        <input type="text" :disabled="sendingMessage == 1" :class="{'disabled':sendingMessage == 1}" placeholder="پیام خود را تایپ کنید ..."  v-model="newMessage" @keyup.enter="sendMessage">
                        <button class="submit" :disabled="sendingMessage == 1" :class="{'disabled':sendingMessage == 1}" @click="sendMessage"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
            <div v-show="loadingMessages" style="display: flex;justify-content: center;align-items: center;margin: auto;">
                <p>در حال بارگیری پیام ها ...</p>
            </div>
            <div v-show="!chatOpen && !loadingMessages" style="display: flex;justify-content: center;align-items: center;margin: auto;">
                <p>برای چت روی یکی از کاربرای لیست کلیک کنید</p>
            </div>
        </div>
    </div>
</div>
