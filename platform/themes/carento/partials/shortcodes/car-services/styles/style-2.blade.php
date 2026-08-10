 <style>
     .service-2-container {
         font-weight: 600;
         margin: 50px auto;
         padding: 20px;
         background: #f2f4f6;
         border-radius: 10px;
     }

     .services-grid {
         display: grid;
         grid-template-columns: repeat(3, 1fr);
         gap: 15px;
     }



     .service-item::before {
         content: "➤ ";
         color: #82b440;
         margin-right: 5px;
     }

     /* Hidden services */
     .more-services {
         display: none;
     }

     .btn-wrapper {
         text-align: center;
         margin-top: 20px;
     }

     .read-more-btn {
         background: #82b440;
         color: #fff;
         border: none;
         padding: 12px 25px;
         cursor: pointer;
         border-radius: 5px;
         font-size: 16px;
     }

     .read-more-btn:hover {
         background: #82b440;
     }

     /* Responsive */
     @media (max-width: 768px) {
         .services-grid {
             grid-template-columns: 1fr;
         }
     }
 </style>

 <section class="shortcode-car-services section-box  py-96  ">
     <div class="container">
        <div class="row">
            @if ($title = $shortcode->title)
                <h2 class="heading-3 shortcode-title">{!! BaseHelper::clean($title) !!}</h2>

            @endif

            @if ($description = $shortcode->description)

                <p class="text-lg-medium shortcode-subtitle">{!! BaseHelper::clean($description) !!}</p>

            @endif

          

        </div>
         <div class="service-2-container ">


             <div class="services-grid">

                 @foreach($services as $index => $service)

                 @php
                    $keyword = trim($shortcode->keyword ?? '');

                    $serviceName = $keyword
                    ? $keyword . ' IN ' . $service->name
                    : $service->name;
                 @endphp

                 <div class="service-item {{ $index >= 15 ? 'more-services' : '' }}">
                     <a href="{{ $service->url }}" style="text-decoration:none; color:inherit;">
                         {{ $serviceName }}
                     </a>
                 </div>

                 @endforeach

             </div>
         </div>
     </div>


     @if(count($services) > 15)
     <div class="btn-wrapper">
         <button id="toggleBtn" class="read-more-btn">Read More</button>
     </div>
     @endif
 </section>


 <script>
     const btn = document.getElementById("toggleBtn");
     const moreServices = document.querySelectorAll(".more-services");

     btn.addEventListener("click", function() {
         moreServices.forEach(el => {
             if (el.style.display === "none" || el.style.display === "") {
                 el.style.display = "block";
             } else {
                 el.style.display = "none";
             }
         });



         btn.innerText = btn.innerText === "Read More" ? "Show Less" : "Read More";
     });
 </script>