@extends('front.base')
@section('head')
 <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endsection
@section('seo')
 <title>kiusk</title>
 <meta name="description"
       content="Here is a precise description of my awesome webpage.">
@endsection
@section('content')
 {{--<div id="app_basic2">--}}

 {{-- <div v-for="c in ca ">@{{c.id}}</div>--}}
 {{-- <todo_list v-bind:todo_list_prop="todoList" class="mb-6 bg-info"/>--}}

 {{--</div>--}}
 <livewire:front.ad.last-ads/>
 {{-- @include('front.pages.home.home.last-ads')--}}
 @php
  $posts=\App\Models\Blog\Post::with(['category','media' => function ($q) {
                 $q->whereCollectionName('SpecialImage');
                },])->latest()->limit(8)->get()->chunk(4);
 @endphp
 @include('front.pages.home.home.articles',['posts'=>$posts,'title'=>'وبلاگ'])
@endsection

@section('script')
 {{-- <script>
    new Vue({
      el: "#app_basic2",
      data: {
        message: "🐵 Hello World 🔮",
        timestamp: `Timestamp ${new Date().toLocaleString()}`,
        todoList: [
          {
            id: 0,
            text: "Brush teeth",
            done: true,
          },
          {
            id: 1,
            text: "Buy chocolate",
            done: false,
          },
          {
            id: 2,
            text: "Sell laptop",
            done: false,
          },
        ],
        ca: @json(\App\Models\Ad\Category::all())
      },
      methods: {
        ee(e) {
          console.log(e.target)
          this.message = 'sss';
          // this.emit('input','sssssssssssss')
          // new Event('input','sssssssssssss')
 //         const event = new Event('build');
 //
 // // Listen for the event.
 //         e.target.addEventListener('build', function (e) { /* ... */ }, false);
 //
 // // Dispatch the event.
 //         e.target.dispatchEvent(event);
 //         new CustomEvent('build', { detail: e.target.dataset.time })
          e.target.dispatchEvent(new CustomEvent('input', {detail: 'ssssssssaaa'}))
          // e.target.dispatchEvent(new Event("input"))
        },
        dd(e) {
          console.log('The time is: ' + e);
        },
      },
    })
    Vue.component("todo_list", {
      props: ["todo_list_prop"],
      template: `<ol>
                  <todo_item v-for="item in todo_list_prop"
                             v-bind:todo_item_prop="item"
                             v-bind:key="item.id"/>
              </ol>`,
    })
    Vue.component("todo_item", {
      props: ["todo_item_prop"],
      template: `<li v-bind:class="{ strike: todo_item_prop.done }">
               @{{ todo_item_prop.text }}
      </li>`,
    })
  </script>--}}
@endsection