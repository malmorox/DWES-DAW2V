from django.urls import path
from . import views

urlpatterns = [
    path('', views.MonthListView.as_view(), name='month_list'),
    path('producto/<int:pk>/', views.ProductDetailView.as_view(), name='product_detail'),
]